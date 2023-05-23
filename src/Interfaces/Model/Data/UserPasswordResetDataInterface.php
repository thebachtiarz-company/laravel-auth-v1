<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface UserPasswordResetDataInterface extends AbstractUserDataInterface
{
    public const ATTRIBUTE_TOKEN = 'token_reset_password';

    // ? Getter Modules

    /**
     * Get token reset password
     */
    public function getToken(): string|null;

    // ? Setter Modules

    /**
     * Set token reset password
     */
    public function setToken(string $token): self;
}
