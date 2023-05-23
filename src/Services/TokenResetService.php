<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Services;

use Exception;
use Illuminate\Support\Str;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\TokenReset;
use TheBachtiarz\Auth\Repositories\TokenResetRepository;
use TheBachtiarz\Auth\Repositories\UserRepository;
use TheBachtiarz\Base\App\Helpers\CarbonHelper;
use TheBachtiarz\Base\App\Services\AbstractService;
use Throwable;

use function assert;
use function in_array;
use function tbauthconfig;

class TokenResetService extends AbstractService
{
    /**
     * Constructor
     */
    public function __construct(
        protected TokenResetRepository $tokenResetRepository,
        protected UserRepository $userRepository,
    ) {
        $this->tokenResetRepository = $tokenResetRepository;
        $this->userRepository       = $userRepository;
    }

    // ? Public Methods

    /**
     * Create token reset
     */
    public function createTokenReset(string $userIdentifier): TokenReset|null
    {
        $result = null;

        try {
            if (! in_array(tbauthconfig(AuthConfigInterface::IDENTITY_METHOD), [UserInterface::ATTRIBUTE_EMAIL])) {
                throw new Exception('Only for email identifier');
            }

            $user = $this->userRepository->getByIdentifier($userIdentifier);
            assert($user instanceof UserInterface);

            $tokenResetPrepare = (new TokenReset())
                ->setToken(Str::uuid()->toString())
                ->setUserIdentifier($user->getEmail())
                ->setExpiresAt(CarbonHelper::dbGetFullDateAddHours());
            assert($tokenResetPrepare instanceof TokenResetInterface);

            $result = $this->tokenResetRepository->create($tokenResetPrepare);

            // TODO: email service

            $this->setResponseData(
                message: 'Successfully create token reset',
                data: [
                    'email' => $result->getUserIdentifier(),
                    'expires' => CarbonHelper::anyConvDateToTimestamp($result->getExpiresAt()),
                ],
            );
        } catch (Throwable $th) {
            $this->log($th);
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);
        }

        return $result;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
