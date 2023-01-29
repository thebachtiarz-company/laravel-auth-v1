<?php

namespace TheBachtiarz\Auth\Models;

use Illuminate\Support\Carbon;
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
    protected $fillable = self::ATTRIBUTES_FILLABLE;

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
        return $this->__get(self::ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenableType(): ?string
    {
        return $this->__get(self::ATTRIBUTE_TOKENABLETYPE);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenableId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_TOKENABLEID);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->__get(self::ATTRIBUTE_NAME);
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
    public function getAbilities(): ?array
    {
        return $this->__get(self::ATTRIBUTE_ABILITIES);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastUsedAt(): ?Carbon
    {
        return $this->__get(self::ATTRIBUTE_LASTUSEDAT);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiresAt(): ?Carbon
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
    public function setTokenableType(string $tokenableType): self
    {
        $this->__set(self::ATTRIBUTE_TOKENABLETYPE, $tokenableType);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokenableId(int $tokenableId): self
    {
        $this->__set(self::ATTRIBUTE_TOKENABLEID, $tokenableId);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->__set(self::ATTRIBUTE_NAME, $name);

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
    public function setAbilities(array $abilities): self
    {
        $this->__set(self::ATTRIBUTE_ABILITIES, $abilities);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastUsedAt(Carbon $lastUsedAt): self
    {
        $this->__set(self::ATTRIBUTE_LASTUSEDAT, $lastUsedAt);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiresAt(Carbon $expiresAt): self
    {
        $this->__set(self::ATTRIBUTE_EXPIRESAT, $expiresAt);

        return $this;
    }
}
