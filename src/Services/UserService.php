<?php

namespace TheBachtiarz\Auth\Services;

use Illuminate\Support\Facades\Hash;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordResetDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordUpdateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Auth\Repositories\PersonalAccessTokenRepository;
use TheBachtiarz\Auth\Repositories\TokenResetRepository;
use TheBachtiarz\Auth\Repositories\UserRepository;
use TheBachtiarz\Base\App\Services\AbstractService;

class UserService extends AbstractService
{
    //

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param PersonalAccessTokenRepository $personalAccessTokenRepository
     * @param TokenResetRepository $tokenResetRepository
     * @param AuthService $authService
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected PersonalAccessTokenRepository $personalAccessTokenRepository,
        protected TokenResetRepository $tokenResetRepository,
        protected AuthService $authService
    ) {
        $this->userRepository = $userRepository;
        $this->personalAccessTokenRepository = $personalAccessTokenRepository;
        $this->tokenResetRepository = $tokenResetRepository;
        $this->authService = $authService;
    }

    // ? Public Methods
    /**
     * Create new user
     *
     * @param UserCreateDataInterface $userCreateDataInterface
     * @return array
     */
    public function createNewUser(UserCreateDataInterface $userCreateDataInterface): array
    {
        $_userPrepare = new User;

        switch (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD)) {
            case UserInterface::ATTRIBUTE_EMAIL:
                $_userPrepare->setEmail($userCreateDataInterface->getIdentifier());
                break;
            case UserInterface::ATTRIBUTE_USERNAME:
                $_userPrepare->setUsername($userCreateDataInterface->getIdentifier());
                break;
            default:
                break;
        }

        $_userPrepare->setPassword($userCreateDataInterface->getPassword());

        /** @var UserInterface $create */
        $create = $this->userRepository->create($_userPrepare);

        $result = [];

        switch (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD)) {
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
            $userCreateDataInterface->getPassword(false)
        );

        $this->setResponseData('Successfully create new user', $result);

        return $result;
    }

    /**
     * User update password
     *
     * @param UserPasswordUpdateDataInterface $userPasswordUpdateDataInterface
     * @return boolean
     */
    public function passwordUpdate(UserPasswordUpdateDataInterface $userPasswordUpdateDataInterface): bool
    {
        $result = false;

        try {
            /** @var UserInterface $user */
            $user = $this->userRepository->getByIdentifier($userPasswordUpdateDataInterface->getIdentifier());

            $checkOldPassword = Hash::check($userPasswordUpdateDataInterface->getPasswordOld(), $user->getPassword());
            if (!$checkOldPassword) throw new \Exception("Incorrect old password");

            $user->setPassword($userPasswordUpdateDataInterface->getPassword());

            $result = !!$this->userRepository->save($user);

            $this->revokeUserTokens($user);
        } catch (\Throwable $th) {
            $this->log($th);
        } finally {
            $this->setResponseData(sprintf('%s update user password', $result ? 'Successfully' : 'Failed to'));

            return $result;
        }
    }

    /**
     * User reset password
     *
     * @param UserPasswordResetDataInterface $userPasswordResetDataInterface
     * @return boolean
     */
    public function passwordReset(UserPasswordResetDataInterface $userPasswordResetDataInterface): bool
    {
        $result = false;

        try {
            /** @var TokenResetInterface $tokenReset */
            $tokenReset = $this->tokenResetRepository->getByToken($userPasswordResetDataInterface->getToken());

            /** @var UserInterface $user */
            $user = $this->userRepository->getByIdentifier($tokenReset->getUserIdentifier());
            $user->setPassword($userPasswordResetDataInterface->getPassword());

            $result = !!$this->userRepository->save($user);

            $this->revokeUserTokens($user);
        } catch (\Throwable $th) {
            $this->log($th);
        } finally {
            $this->setResponseData(sprintf('%s reset user password', $result ? 'Successfully' : 'Failed to'));

            return $result;
        }
    }

    // ? Protected Methods

    // ? Private Methods
    /**
     * Revoke speciic user tokens
     *
     * @param UserInterface $userInterface
     * @return void
     */
    private function revokeUserTokens(UserInterface $userInterface): void
    {
        $tokens = $this->personalAccessTokenRepository->setCurrentUser($userInterface)->get();

        /** @var \TheBachtiarz\Auth\Models\PersonalAccessToken $token */
        foreach ($tokens ?? [] as $key => $token) {
            $this->personalAccessTokenRepository->deleteByName($token->getName());
        }
    }

    // ? Getter Modules

    // ? Setter Modules
}
