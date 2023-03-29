<?php

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface UserPasswordUpdateDataInterface extends AbstractUserDataInterface
{
    public const ATTRIBUTE_PASSWORD_OLD = 'password_old';

    // ? Getter Modules
    /**
     * Get password old
     *
     * @param boolean $hashed
     * @return string|null
     */
    public function getPasswordOld(bool $hashed = false): ?string;

    // ? Setter Modules
    /**
     * Set password old
     *
     * @param string $passwordOld
     * @return self
     */
    public function setPasswordOld(string $passwordOld): self;
}
