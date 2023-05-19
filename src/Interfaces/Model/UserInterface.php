<?php

namespace TheBachtiarz\Auth\Interfaces\Model;

use Illuminate\Support\Carbon;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

interface UserInterface extends AbstractModelInterface
{
    /**
     * Table name
     *
     * @var string
     */
    public const TABLE_NAME = 'users';

    /**
     * Model attributes for email identity fillable
     *
     * @var array
     */
    public const ATTRIBUTES_EMAIL_IDENTITY_FILLABLE = [
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_EMAIL_VERIFIED_AT,
        self::ATTRIBUTE_PASSWORD
    ];

    /**
     * Model attributes for username identity fillable
     *
     * @var array
     */
    public const ATTRIBUTES_USERNAME_IDENTITY_FILLABLE = [
        self::ATTRIBUTE_USERNAME,
        self::ATTRIBUTE_PASSWORD
    ];

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_EMAIL = 'email';
    public const ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const ATTRIBUTE_USERNAME = 'username';
    public const ATTRIBUTE_PASSWORD = 'password';

    // ? Getter Modules
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
     * @return Carbon|null
     */
    public function getTokenExpiresAt(): ?Carbon;

    // ? Setter Modules

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
     * @param Carbon $tokenExpiresAt Determine token expiration time
     * @return self
     */
    public function setTokenExpiresAt(Carbon $tokenExpiresAt): self;
}
