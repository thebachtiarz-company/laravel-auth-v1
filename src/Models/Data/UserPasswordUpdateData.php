<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models\Data;

use Illuminate\Support\Facades\Hash;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordUpdateDataInterface;

class UserPasswordUpdateData extends AbstractUserData implements UserPasswordUpdateDataInterface
{
    public function getPasswordOld(bool $hashed = false): string|null
    {
        if (@$this->data[self::ATTRIBUTE_PASSWORD_OLD]) {
            return $hashed ? Hash::make($this->data[self::ATTRIBUTE_PASSWORD_OLD]) : $this->data[self::ATTRIBUTE_PASSWORD_OLD];
        }

        return null;
    }

    public function setPasswordOld(string $passwordOld): self
    {
        $this->data[self::ATTRIBUTE_PASSWORD_OLD] = $passwordOld;

        return $this;
    }
}
