<?php

namespace TheBachtiarz\Auth\Models;

use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Traits\Model\TokenResetScopeTrait;
use TheBachtiarz\Base\App\Models\AbstractModel;

class TokenReset extends AbstractModel implements TokenResetInterface
{
    use TokenResetScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $table = self::TABLE_NAME;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::ATTRIBUTES_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getToken(): ?string
    {
        return $this->__get(self::ATTRIBUTE_TOKEN);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserIdentifier(): ?string
    {
        return $this->__get(self::ATTRIBUTE_USERIDENTIFIER);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiresAt(): ?string
    {
        return $this->__get(self::ATTRIBUTE_EXPIRESAT);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setToken(string $token): self
    {
        $this->__set(self::ATTRIBUTE_TOKEN, $token);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUserIdentifier(string $userIdentifier): self
    {
        $this->__set(self::ATTRIBUTE_USERIDENTIFIER, $userIdentifier);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiresAt(string $expiresAt): self
    {
        $this->__set(self::ATTRIBUTE_EXPIRESAT, $expiresAt);

        return $this;
    }
}
