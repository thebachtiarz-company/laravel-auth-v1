<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Interfaces\Model;

use Illuminate\Support\Carbon;

interface PersonalAccessTokenInterface
{
    /**
     * Model attributes
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_TOKEN,
        self::ATTRIBUTE_ABILITIES,
        self::ATTRIBUTE_EXPIRESAT,
    ];

    public const ATTRIBUTE_ID            = 'id';
    public const ATTRIBUTE_TOKENABLETYPE = 'tokenable_type';
    public const ATTRIBUTE_TOKENABLEID   = 'tokenable_id';
    public const ATTRIBUTE_NAME          = 'name';
    public const ATTRIBUTE_TOKEN         = 'token';
    public const ATTRIBUTE_ABILITIES     = 'abilities';
    public const ATTRIBUTE_LASTUSEDAT    = 'last_used_at';
    public const ATTRIBUTE_EXPIRESAT     = 'expires_at';

    // ? Getter Modules

    /**
     * Get id
     */
    public function getId(): int|null;

    /**
     * Get tokenable type
     */
    public function getTokenableType(): string|null;

    /**
     * Get tokenable id
     */
    public function getTokenableId(): int|null;

    /**
     * Get name
     */
    public function getName(): string|null;

    /**
     * Get token
     */
    public function getToken(): string|null;

    /**
     * Get abilities
     */
    public function getAbilities(): array|null;

    /**
     * Get last used at
     */
    public function getLastUsedAt(): Carbon|null;

    /**
     * Get expires at
     */
    public function getExpiresAt(): Carbon|null;

    // ? Setter Modules

    /**
     * Set id
     */
    public function setId(int $id): self;

    /**
     * Set tokenable type
     */
    public function setTokenableType(string $tokenableType): self;

    /**
     * tokenable id
     */
    public function setTokenableId(int $tokenableId): self;

    /**
     * Set name
     */
    public function setName(string $name): self;

    /**
     * Set token
     */
    public function setToken(string $token): self;

    /**
     * Set abilities
     *
     * @param array $abilities
     */
    public function setAbilities(array $abilities): self;

    /**
     * Set last used at
     */
    public function setLastUsedAt(Carbon $lastUsedAt): self;

    /**
     * Set expires at
     */
    public function setExpiresAt(Carbon $expiresAt): self;
}
