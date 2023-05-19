<?php

namespace TheBachtiarz\Auth\Interfaces\Model;

use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

interface TokenResetInterface extends AbstractModelInterface
{
    /**
     * Table name
     *
     * @var string
     */
    public const TABLE_NAME = 'token_resets';

    /**
     * Model attributes
     *
     * @var array
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_TOKEN,
        self::ATTRIBUTE_USERIDENTIFIER,
        self::ATTRIBUTE_EXPIRESAT
    ];

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_TOKEN = 'token';
    public const ATTRIBUTE_USERIDENTIFIER = 'user_identifier';
    public const ATTRIBUTE_EXPIRESAT = 'expires_at';

    // ? Getter Modules
    /**
     * Get token reset
     *
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * Get user identifier
     *
     * @return string|null
     */
    public function getUserIdentifier(): ?string;

    /**
     * Get expires at
     *
     * @return string|null
     */
    public function getExpiresAt(): ?string;

    // ? Setter Modules
    /**
     * Set token reset
     *
     * @param string $token
     * @return self
     */
    public function setToken(string $token): self;

    /**
     * Set user identifier
     *
     * @param string $userIdentifier
     * @return self
     */
    public function setUserIdentifier(string $userIdentifier): self;

    /**
     * Set expires at
     *
     * @param string $expiresAt
     * @return self
     */
    public function setExpiresAt(string $expiresAt): self;
}
