<?php

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

class PersonalAccessTokenRepository extends AbstractRepository
{
    //

    /**
     * Current auth user
     *
     * @var UserInterface|null
     */
    private ?UserInterface $currentUser = null;

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

        $_collection = PersonalAccessToken::getOwnTokens($this->currentUser);

        return $_collection->get();
    }

    /**
     * Get token by name
     *
     * @param string $tokenName
     * @return PersonalAccessTokenInterface|null
     */
    public function getByName(string $tokenName): ?PersonalAccessTokenInterface
    {
        $this->authenticate();

        $_token = PersonalAccessToken::getOwnTokenByName($this->currentUser, $tokenName)->first();

        return $_token;
    }

    /**
     * Create a new token
     *
     * @param UserInterface $userInterface
     * @return NewAccessToken
     */
    public function create(UserInterface $userInterface): NewAccessToken
    {
        $this->authenticate();

        /** @var User $userInterface */
        $_create = $userInterface->createToken(
            name: Str::uuid()->toString(),
            expiresAt: $userInterface->getTokenExpiresAt()
        );

        return $_create;
    }

    /**
     * Delete token by name
     *
     * @param string $tokenName
     * @return boolean
     */
    public function deleteByName(string $tokenName): bool
    {
        /** @var PersonalAccessToken|null $_token */
        $_token = $this->getByName($tokenName);

        return $_token?->delete() ?? false;
    }

    // ? Protected Methods
    /**
     * Check is authenticated
     *
     * @return void
     * @throws AuthenticationException
     */
    protected function authenticate(): void
    {
        if (!$this->currentUser) {
            if (!Auth::hasUser()) throw new AuthenticationException();

            $this->currentUser = $this->getCurrentUserSession();
        }
    }

    /**
     * Get current user session
     *
     * @return UserInterface
     */
    protected function getCurrentUserSession(): UserInterface
    {
        /** @var \TheBachtiarz\Auth\Repositories\UserRepository $userRepository */
        $userRepository = \Illuminate\Container\Container::getInstance()->make(\TheBachtiarz\Auth\Repositories\UserRepository::class);

        return $userRepository->getById(Auth::user()->id);
    }

    // ? Setter Modules
    /**
     * Set current user
     *
     * @param UserInterface $userInterface
     * @return self
     */
    public function setCurrentUser(UserInterface $userInterface): self
    {
        $this->currentUser = $userInterface;

        return $this;
    }
}
