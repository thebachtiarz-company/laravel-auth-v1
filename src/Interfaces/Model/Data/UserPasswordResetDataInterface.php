<?php

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface UserPasswordResetDataInterface extends AbstractUserDataInterface
{
    public const ATTRIBUTE_TOKEN = 'token_reset_password';

    // ? Getter Modules
    /**
     * Get token reset password
     *
     * @return string|null
     */
    public function getToken(): ?string;

    // ? Setter Modules
    /**
     * Set token reset password
     *
     * @param string $token
     * @return self
     */
    public function setToken(string $token): self;
}
