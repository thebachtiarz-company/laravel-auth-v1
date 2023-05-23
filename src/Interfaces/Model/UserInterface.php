<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Interfaces\Model;

use Illuminate\Support\Carbon;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

interface UserInterface extends AbstractModelInterface
{
    /**
     * Table name
     */
    public const TABLE_NAME = 'users';

    /**
     * Model attributes for email identity fillable
     */
    public const ATTRIBUTES_EMAIL_IDENTITY_FILLABLE = [
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_EMAIL_VERIFIED_AT,
        self::ATTRIBUTE_PASSWORD,
    ];

    /**
     * Model attributes for username identity fillable
     */
    public const ATTRIBUTES_USERNAME_IDENTITY_FILLABLE = [
        self::ATTRIBUTE_USERNAME,
        self::ATTRIBUTE_PASSWORD,
    ];

    public const ATTRIBUTE_EMAIL             = 'email';
    public const ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const ATTRIBUTE_USERNAME          = 'username';
    public const ATTRIBUTE_PASSWORD          = 'password';

    // ? Getter Modules

    /**
     * Get email
     */
    public function getEmail(): string|null;

    /**
     * Get email verified at
     */
    public function getEmailVerifiedAt(): string|null;

    /**
     * Get username
     */
    public function getUsername(): string|null;

    /**
     * Get password
     */
    public function getPassword(): string|null;

    /**
     * Get defined user class model.
     * Override purposes.
     */
    public function getClassModel(): User;

    /**
     * Get token expires at
     */
    public function getTokenExpiresAt(): Carbon|null;

    // ? Setter Modules

    /**
     * Set email
     */
    public function setEmail(string $email): self;

    /**
     * Set email verified at
     */
    public function setEmailVerifiedAt(string $emailVerifiedAt): self;

    /**
     * Set username
     */
    public function setUsername(string $username): self;

    /**
     * Set Password
     */
    public function setPassword(string $password): self;

    /**
     * Define user class model.
     * Override purposes.
     */
    public function setClassModel(User $user): self;

    /**
     * Set token expires at
     *
     * @param Carbon $tokenExpiresAt Determine token expiration time
     */
    public function setTokenExpiresAt(Carbon $tokenExpiresAt): self;
}
