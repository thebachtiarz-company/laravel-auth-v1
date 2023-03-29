<?php

namespace TheBachtiarz\Auth\Models\Data;

use TheBachtiarz\Auth\Interfaces\Model\Data\UserPasswordResetDataInterface;

class UserPasswordResetData extends AbstractUserData implements UserPasswordResetDataInterface
{
    //

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getToken(): ?string
    {
        return @$this->data[self::ATTRIBUTE_TOKEN];
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setToken(string $token): self
    {
        $this->data[self::ATTRIBUTE_TOKEN] = $token;

        return $this;
    }
}
