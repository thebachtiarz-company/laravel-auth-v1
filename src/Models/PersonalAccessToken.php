<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Traits\Model\PersonalAccessTokenMapTrait;
use TheBachtiarz\Auth\Traits\Model\PersonalAccessTokenScopeTrait;

class PersonalAccessToken extends SanctumPersonalAccessToken implements PersonalAccessTokenInterface
{
    use PersonalAccessTokenMapTrait;
    use PersonalAccessTokenScopeTrait;

    protected $fillable = self::ATTRIBUTES_FILLABLE;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_ID);
    }

    public function getTokenableType(): string|null
    {
        return $this->__get(self::ATTRIBUTE_TOKENABLETYPE);
    }

    public function getTokenableId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_TOKENABLEID);
    }

    public function getName(): string|null
    {
        return $this->__get(self::ATTRIBUTE_NAME);
    }

    public function getToken(): string|null
    {
        return $this->__get(self::ATTRIBUTE_TOKEN);
    }

    public function getAbilities(): array|null
    {
        return $this->__get(self::ATTRIBUTE_ABILITIES);
    }

    public function getLastUsedAt(): Carbon|null
    {
        return $this->__get(self::ATTRIBUTE_LASTUSEDAT);
    }

    public function getExpiresAt(): Carbon|null
    {
        return $this->__get(self::ATTRIBUTE_EXPIRESAT);
    }

    public function setId(int $id): self
    {
        $this->__set(self::ATTRIBUTE_ID, $id);

        return $this;
    }

    public function setTokenableType(string $tokenableType): self
    {
        $this->__set(self::ATTRIBUTE_TOKENABLETYPE, $tokenableType);

        return $this;
    }

    public function setTokenableId(int $tokenableId): self
    {
        $this->__set(self::ATTRIBUTE_TOKENABLEID, $tokenableId);

        return $this;
    }

    public function setName(string $name): self
    {
        $this->__set(self::ATTRIBUTE_NAME, $name);

        return $this;
    }

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

    public function setLastUsedAt(Carbon $lastUsedAt): self
    {
        $this->__set(self::ATTRIBUTE_LASTUSEDAT, $lastUsedAt);

        return $this;
    }

    public function setExpiresAt(Carbon $expiresAt): self
    {
        $this->__set(self::ATTRIBUTE_EXPIRESAT, $expiresAt);

        return $this;
    }
}
