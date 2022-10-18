<?php

namespace TheBachtiarz\Auth\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TheBachtiarz\Auth\Interfaces\Model\UserModelInterface;
use TheBachtiarz\Auth\Traits\Model\UserScopeTrait;

class User extends Authenticatable implements UserModelInterface
{
    use HasApiTokens, Notifiable, SoftDeletes;

    use UserScopeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = tbauthconfig('user_auth_identity_method') === 'email'
            ? UserModelInterface::USER_ATTRIBUTES_EMAIL_IDENTITY
            : UserModelInterface::USER_ATTRIBUTES_USERNAME_IDENTITY;
    }

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): ?string
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_EMAIL);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailVerifiedAt(): ?string
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_EMAIL_VERIFIED_AT);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername(): ?string
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_USERNAME);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(): ?string
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_PASSWORD);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): self
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_ID, $id);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): self
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_EMAIL, $email);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailVerifiedAt(string $emailVerifiedAt): self
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_EMAIL_VERIFIED_AT, $emailVerifiedAt);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername(string $username): self
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_USERNAME, $username);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password): self
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_PASSWORD, $password);

        return $this;
    }
}
