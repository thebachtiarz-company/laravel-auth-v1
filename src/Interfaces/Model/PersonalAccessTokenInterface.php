<?php

namespace TheBachtiarz\Auth\Interfaces\Model;

use Illuminate\Support\Carbon;

interface PersonalAccessTokenInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const PAT_ATTRIBUTES_FILLABLE = [
        self::PAT_ATTRIBUTE_NAME,
        self::PAT_ATTRIBUTE_TOKEN,
        self::PAT_ATTRIBUTE_ABILITIES,
        self::PAT_ATTRIBUTE_EXPIRESAT
    ];

    public const PAT_ATTRIBUTE_ID = 'id';
    public const PAT_ATTRIBUTE_TOKENABLETYPE = 'tokenable_type';
    public const PAT_ATTRIBUTE_TOKENABLEID = 'tokenable_id';
    public const PAT_ATTRIBUTE_NAME = 'name';
    public const PAT_ATTRIBUTE_TOKEN = 'token';
    public const PAT_ATTRIBUTE_ABILITIES = 'abilities';
    public const PAT_ATTRIBUTE_LASTUSEDAT = 'last_used_at';
    public const PAT_ATTRIBUTE_EXPIRESAT = 'expires_at';

    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * Get tokenable type
     *
     * @return string|null
     */
    public function getTokenableType(): ?string;

    /**
     * Get tokenable id
     *
     * @return integer|null
     */
    public function getTokenableId(): ?int;

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Get token
     *
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * Get abilities
     *
     * @return array|null
     */
    public function getAbilities(): ?array;

    /**
     * Get last used at
     *
     * @return Carbon|null
     */
    public function getLastUsedAt(): ?Carbon;

    /**
     * Get expires at
     *
     * @return Carbon|null
     */
    public function getExpiresAt(): ?Carbon;

    // ? Setter Modules
    /**
     * Set id
     *
     * @param integer $id
     * @return self
     */
    public function setId(int $id): self;

    /**
     * Set tokenable type
     *
     * @param string $tokenableType
     * @return self
     */
    public function setTokenableType(string $tokenableType): self;

    /**
     * tokenable id
     *
     * @param integer $tokenableId
     * @return self
     */
    public function setTokenableId(int $tokenableId): self;

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * Set token
     *
     * @param string $token
     * @return self
     */
    public function setToken(string $token): self;

    /**
     * Set abilities
     *
     * @param array $abilities
     * @return self
     */
    public function setAbilities(array $abilities): self;

    /**
     * Set last used at
     *
     * @param Carbon $lastUsedAt
     * @return self
     */
    public function setLastUsedAt(Carbon $lastUsedAt): self;

    /**
     * Set expires at
     *
     * @param Carbon $expiresAt
     * @return self
     */
    public function setExpiresAt(Carbon $expiresAt): self;
}
