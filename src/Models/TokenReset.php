<?php

namespace TheBachtiarz\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Traits\Model\TokenResetScopeTrait;

class TokenReset extends Model implements TokenResetInterface
{
    use TokenResetScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::ATTRIBUTES_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_ID);
    }

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
    public function setId(int $id): self
    {
        $this->__set(self::ATTRIBUTE_ID, $id);

        return $this;
    }

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
