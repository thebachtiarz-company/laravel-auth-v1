<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\PersonalAccessToken;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;

use function app;
use function assert;

class PersonalAccessTokenRepository extends AbstractRepository
{
    /**
     * Current auth user
     */
    private UserInterface|null $currentUser = null;

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->currentUser = null;
    }

    // ? Public Methods

    /**
     * Get current auth tokens
     *
     * @return Collection<PersonalAccessTokenInterface>
     */
    public function get(): Collection
    {
        $this->authenticate();

        $collection = PersonalAccessToken::getOwnTokens($this->currentUser);

        return $collection->get();
    }

    /**
     * Get token by name
     */
    public function getByName(string $tokenName): PersonalAccessTokenInterface|null
    {
        $this->authenticate();

        return PersonalAccessToken::getOwnTokenByName($this->currentUser, $tokenName)->first();
    }

    /**
     * Create a new token
     */
    public function create(UserInterface $userInterface): NewAccessToken
    {
        $this->authenticate();

        /** @var User $userInterface */
        return $userInterface->createToken(
            name: Str::uuid()->toString(),
            expiresAt: $userInterface->getTokenExpiresAt(),
        );
    }

    /**
     * Delete token by name
     */
    public function deleteByName(string $tokenName): bool
    {
        $token = $this->getByName($tokenName);
        assert($token instanceof PersonalAccessToken || $token === null);

        return $token?->delete() ?? false;
    }

    // ? Protected Methods

    /**
     * Check is authenticated
     *
     * @throws AuthenticationException
     */
    protected function authenticate(): void
    {
        if ($this->currentUser) {
            return;
        }

        if (! Auth::hasUser()) {
            throw new AuthenticationException();
        }

        $this->currentUser = $this->getCurrentUserSession();
    }

    /**
     * Get current user session
     */
    protected function getCurrentUserSession(): UserInterface
    {
        $userRepository = app(UserRepository::class);
        assert($userRepository instanceof UserRepository);

        return $userRepository->getById(Auth::user()->id);
    }

    // ? Setter Modules

    /**
     * Set current user
     */
    public function setCurrentUser(UserInterface $userInterface): self
    {
        $this->currentUser = $userInterface;

        return $this;
    }
}
