<?php

namespace TheBachtiarz\Auth\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Traits\Model\PersonalAccessTokenMapTrait;
use TheBachtiarz\Auth\Traits\Model\PersonalAccessTokenScopeTrait;

class PersonalAccessToken extends SanctumPersonalAccessToken implements PersonalAccessTokenInterface
{
    use PersonalAccessTokenMapTrait, PersonalAccessTokenScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = PersonalAccessTokenInterface::PAT_ATTRIBUTES_FILLABLE;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenableType(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLETYPE);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenableId(): ?int
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLEID);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_NAME);
    }

    /**
     * {@inheritDoc}
     */
    public function getToken(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKEN);
    }

    /**
     * {@inheritDoc}
     */
    public function getAbilities(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_ABILITIES);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastUsedAt(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_LASTUSEDAT);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiresAt(): ?string
    {
        return $this->__get(PersonalAccessTokenInterface::PAT_ATTRIBUTE_EXPIRESAT);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_ID, $id);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokenableType(string $tokenableType): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLETYPE, $tokenableType);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokenableId(int $tokenableId): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLEID, $tokenableId);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_NAME, $name);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setToken(string $token): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKEN, $token);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAbilities(string $abilities): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_ABILITIES, $abilities);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastUsedAt(string $lastUsedAt): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_LASTUSEDAT, $lastUsedAt);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiresAt(string $expiresAt): self
    {
        $this->__set(PersonalAccessTokenInterface::PAT_ATTRIBUTE_EXPIRESAT, $expiresAt);

        return $this;
    }
}
