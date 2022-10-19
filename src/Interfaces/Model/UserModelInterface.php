<?php

namespace TheBachtiarz\Auth\Interfaces\Model;

use TheBachtiarz\Auth\Models\User;

interface UserModelInterface
{
    /**
     * Model attributes for email identity fillable
     *
     * @var array
     */
    public const USER_ATTRIBUTES_EMAIL_IDENTITY_FILLABLE = [
        self::USER_ATTRIBUTE_EMAIL,
        self::USER_ATTRIBUTE_EMAIL_VERIFIED_AT,
        self::USER_ATTRIBUTE_PASSWORD
    ];

    /**
     * Model attributes for username identity fillable
     *
     * @var array
     */
    public const USER_ATTRIBUTES_USERNAME_IDENTITY_FILLABLE = [
        self::USER_ATTRIBUTE_USERNAME,
        self::USER_ATTRIBUTE_PASSWORD
    ];

    public const USER_ATTRIBUTE_ID = 'id';
    public const USER_ATTRIBUTE_EMAIL = 'email';
    public const USER_ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const USER_ATTRIBUTE_USERNAME = 'username';
    public const USER_ATTRIBUTE_PASSWORD = 'password';

    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Get email verified at
     *
     * @return string|null
     */
    public function getEmailVerifiedAt(): ?string;

    /**
     * Get username
     *
     * @return string|null
     */
    public function getUsername(): ?string;

    /**
     * Get password
     *
     * @return string|null
     */
    public function getPassword(): ?string;

    /**
     * Get defined user class model.
     * Override purposes.
     *
     * @return User
     */
    public function getClassModel(): User;

    /**
     * Get token expires at
     *
     * @return string|null
     */
    public function getTokenExpiresAt(): ?string;

    // ? Setter Modules
    /**
     * Set id
     *
     * @param integer $id
     * @return self
     */
    public function setId(int $id): self;

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self;

    /**
     * Set email verified at
     *
     * @param string $emailVerifiedAt
     * @return self
     */
    public function setEmailVerifiedAt(string $emailVerifiedAt): self;

    /**
     * Set username
     *
     * @param string $username
     * @return self
     */
    public function setUsername(string $username): self;

    /**
     * Set Password
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self;

    /**
     * Define user class model.
     * Override purposes.
     *
     * @param User $user
     * @return self
     */
    public function setClassModel(User $user): self;

    /**
     * Set token expires at
     *
     * @param string $tokenExpiresAt Determine token expiration time
     * @return self
     */
    public function setTokenExpiresAt(string $tokenExpiresAt): self;
}
