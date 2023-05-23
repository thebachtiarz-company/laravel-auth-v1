<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Services;

use Exception;
use Illuminate\Support\Facades\Hash;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordResetDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordUpdateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\PersonalAccessToken;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Auth\Repositories\PersonalAccessTokenRepository;
use TheBachtiarz\Auth\Repositories\TokenResetRepository;
use TheBachtiarz\Auth\Repositories\UserRepository;
use TheBachtiarz\Base\App\Helpers\CarbonHelper;
use TheBachtiarz\Base\App\Services\AbstractService;
use Throwable;

use function assert;
use function sprintf;
use function tbauthconfig;

class UserService extends AbstractService
{
    /**
     * Constructor
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected PersonalAccessTokenRepository $personalAccessTokenRepository,
        protected TokenResetRepository $tokenResetRepository,
        protected AuthService $authService,
        protected CarbonHelper $carbonHelper,
    ) {
        $this->userRepository                = $userRepository;
        $this->personalAccessTokenRepository = $personalAccessTokenRepository;
        $this->tokenResetRepository          = $tokenResetRepository;
        $this->authService                   = $authService;
        $this->carbonHelper                  = $carbonHelper;
    }

    // ? Public Methods

    /**
     * Create new user
     *
     * @return array
     */
    public function createNewUser(UserCreateDataInterface $userCreateDataInterface): array
    {
        try {
            $userPrepare = new User();

            $checkUserExist = $this->checkUserExistByIdentifier($userCreateDataInterface->getIdentifier());
            if ($checkUserExist) {
                throw new Exception(sprintf(
                    "User with %s '%s' already exist",
                    tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false),
                    $userCreateDataInterface->getIdentifier(),
                ));
            }

            switch (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false)) {
                case UserInterface::ATTRIBUTE_EMAIL:
                    $userPrepare->setEmail($userCreateDataInterface->getIdentifier());
                    break;
                case UserInterface::ATTRIBUTE_USERNAME:
                    $userPrepare->setUsername($userCreateDataInterface->getIdentifier());
                    break;
                default:
                    break;
            }

            $userPrepare->setPassword($userCreateDataInterface->getPassword());

            $create = $this->userRepository->create($userPrepare);
            assert($create instanceof UserInterface);

            $result = [];

            switch (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false)) {
                case UserInterface::ATTRIBUTE_EMAIL:
                    $result[UserInterface::ATTRIBUTE_EMAIL] = $create->getEmail();
                    break;
                case UserInterface::ATTRIBUTE_USERNAME:
                    $result[UserInterface::ATTRIBUTE_USERNAME] = $create->getUsername();
                    break;
                default:
                    break;
            }

            $result['authorization'] = $this->authService->createToken(
                $userCreateDataInterface->getIdentifier(),
                $userCreateDataInterface->getPassword(false),
            );

            $this->setResponseData(message: 'Successfully create new user', data: $result);

            return $result;
        } catch (Throwable $th) {
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);

            return [];
        }
    }

    /**
     * User update password
     *
     * @return array
     */
    public function passwordUpdate(UserPasswordUpdateDataInterface $userPasswordUpdateDataInterface): array
    {
        try {
            $user = $this->userRepository->getByIdentifier($userPasswordUpdateDataInterface->getIdentifier());
            assert($user instanceof UserInterface);

            $checkOldPassword = Hash::check($userPasswordUpdateDataInterface->getPasswordOld(), $user->getPassword());
            if (! $checkOldPassword) {
                throw new Exception('Incorrect old password');
            }

            $user->setPassword($userPasswordUpdateDataInterface->getPassword());

            $process = $this->userRepository->save($user);

            $this->revokeUserTokens($user);

            $this->setResponseData(message: sprintf('%s update user password', (bool) $process ? 'Successfully' : 'Failed to'));

            return $this->serviceResult(status: (bool) $process, message: sprintf('%s update user password', (bool) $process ? 'Successfully' : 'Failed to'));
        } catch (Throwable $th) {
            $this->log($th);
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);

            return $this->serviceResult(message: $th->getMessage());
        }
    }

    /**
     * User reset password
     *
     * @return array
     */
    public function passwordReset(UserPasswordResetDataInterface $userPasswordResetDataInterface): array
    {
        try {
            $tokenReset = $this->tokenResetRepository->getByToken($userPasswordResetDataInterface->getToken());
            assert($tokenReset instanceof TokenResetInterface);

            /**
             * Check is token has expired
             */
            if (
                $this->carbonHelper->anyConvDateToTimestamp() >=
                $this->carbonHelper->anyConvDateToTimestamp($tokenReset->getExpiresAt())
            ) {
                throw new Exception('Token reset has expired');
            }

            $user = $this->userRepository->getByIdentifier($tokenReset->getUserIdentifier());
            assert($user instanceof UserInterface);
            $user->setPassword($userPasswordResetDataInterface->getPassword());

            $process = $this->userRepository->save($user);

            /**
             * Delete token reset by user identifier
             */
            $this->tokenResetRepository->deleteByUserIdentifier($tokenReset->getUserIdentifier());

            $this->revokeUserTokens($user);

            $this->setResponseData(sprintf('%s reset user password', (bool) $process ? 'Successfully' : 'Failed to'));

            return $this->serviceResult(status: (bool) $process, message: sprintf('%s reset user password', (bool) $process ? 'Successfully' : 'Failed to'));
        } catch (Throwable $th) {
            $this->log($th);
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);

            return $this->serviceResult(message: $th->getMessage());
        }
    }

    // ? Protected Methods

    /**
     * Check is user is already exist
     */
    protected function checkUserExistByIdentifier(string $identifier): bool
    {
        $user = User::getByIdentifier($identifier)->first();

        return (bool) $user;
    }

    // ? Private Methods

    /**
     * Revoke speciic user tokens
     */
    private function revokeUserTokens(UserInterface $userInterface): void
    {
        $tokens = $this->personalAccessTokenRepository->setCurrentUser($userInterface)->get();

        foreach ($tokens ?? [] as $key => $token) {
            assert($token instanceof PersonalAccessToken);
            $this->personalAccessTokenRepository->deleteByName($token->getName());
        }
    }

    // ? Getter Modules

    // ? Setter Modules
}
