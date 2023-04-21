<?php

namespace TheBachtiarz\Auth\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Repositories\PersonalAccessTokenRepository;
use TheBachtiarz\Auth\Repositories\UserRepository;
use TheBachtiarz\Base\App\Helpers\CarbonHelper;
use TheBachtiarz\Base\App\Services\AbstractService;

class AuthService extends AbstractService
{
    //

    /**
     * User Interface
     *
     * @var UserInterface
     */
    private UserInterface $userInterface;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param PersonalAccessTokenRepository $personalAccessTokenRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected PersonalAccessTokenRepository $personalAccessTokenRepository
    ) {
        $this->userRepository = $userRepository;
        $this->personalAccessTokenRepository = $personalAccessTokenRepository;
    }

    // ? Public Methods
    /**
     * Get current auth user
     *
     * @return UserInterface
     */
    public function getCurrentAuthUser(): UserInterface
    {
        if (!Auth::hasUser()) throw new AuthenticationException;

        $this->userInterface = $this->userRepository->getById(Auth::user()->id);

        $this->setResponseData('Current auth user');

        return $this->userInterface;
    }

    /**
     * Create user session
     *
     * @param string $identifier
     * @param string $password
     * @return UserInterface
     */
    public function createSession(string $identifier, string $password): UserInterface
    {
        $attempt = Auth::attempt(
            credentials: [
                tbauthconfig(AuthConfigInterface::IDENTITY_METHOD) => $identifier,
                UserInterface::ATTRIBUTE_PASSWORD => $password
            ]
        );

        if (!$attempt) throw new ModelNotFoundException('Credential not found');

        $this->setResponseData('User session successfully created');

        return $this->getCurrentAuthUser();
    }

    /**
     * Create user token
     *
     * @param string $identifier
     * @param string $password
     * @return array
     */
    public function createToken(string $identifier, string $password): array
    {
        $this->createSession($identifier, $password);

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = $this->personalAccessTokenRepository->create($this->userInterface);

        $result = [
            'name' => $token->accessToken->name,
            'token' => $token->plainTextToken,
            'expired' => @$token->accessToken->expires_at ? CarbonHelper::anyConvDateToTimestamp($token->accessToken->expires_at) : 'Never'
        ];

        $this->setResponseData('User token successfully created', $result);

        return $result;
    }

    /**
     * Get all user token
     *
     * @return array
     */
    public function getTokens(): array
    {
        $tokens = $this->personalAccessTokenRepository->get();

        /** @var \TheBachtiarz\Auth\Models\PersonalAccessToken $token */
        $result = [...array_map(fn ($token): array => $token->simpleListMap(), $tokens->all())];

        $this->setResponseData('List user token', $result);

        return $result;
    }

    /**
     * Delete user token by name
     *
     * @param string $tokenName
     * @return boolean
     */
    public function deleteToken(string $tokenName): bool
    {
        $process = $this->personalAccessTokenRepository->deleteByName($tokenName);

        $this->setResponseData(sprintf("%s delete token", $process ? 'Successfully' : 'Failed to'));

        return $process;
    }

    /**
     * Revoke user token
     *
     * @return boolean
     */
    public function revokeToken(): bool
    {
        $tokens = $this->personalAccessTokenRepository->get();

        /** @var \TheBachtiarz\Auth\Models\PersonalAccessToken $token */
        foreach ($tokens ?? [] as $key => $token) {
            $this->deleteToken($token->getName());
        }

        $this->setResponseData('Successfully revoke user token');

        return true;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
