<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface UserPasswordUpdateDataInterface extends AbstractUserDataInterface
{
    public const ATTRIBUTE_PASSWORD_OLD = 'password_old';

    // ? Getter Modules

    /**
     * Get password old
     */
    public function getPasswordOld(bool $hashed = false): string|null;

    // ? Setter Modules

    /**
     * Set password old
     */
    public function setPasswordOld(string $passwordOld): self;
}
