<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models\Data;

use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordResetDataInterface;

class UserPasswordResetData extends AbstractUserData implements UserPasswordResetDataInterface
{
    public function getToken(): string|null
    {
        return @$this->data[self::ATTRIBUTE_TOKEN];
    }

    public function setToken(string $token): self
    {
        $this->data[self::ATTRIBUTE_TOKEN] = $token;

        return $this;
    }
}
