<?php

namespace TheBachtiarz\Auth\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Traits\Model\UserScopeTrait;

class User extends Authenticatable implements UserInterface
{
    use HasApiTokens, Notifiable, SoftDeletes;

    use UserScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $table = self::TABLE_NAME;

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Define class model.
     * Override purposes.
     *
     * @var self
     */
    protected self $classModel;

    /**
     * Define token expires at.
     *
     * example: \TheBachtiarz\Base\App\Helpers\CarbonHelper::dbGetFullDateAddHours(1) -> to add 1 hour after token created.
     *
     * @var Carbon|null
     */
    protected ?Carbon $tokenExpiresAt = null;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->classModel = $this;
        $this->fillable($this->mutateFillable());
    }

    // ? Public Methods
    /**
     * {@inheritDoc}
     */
    public function getData(string $attribute): mixed
    {
        return $this->__get($attribute);
    }

    /**
     * {@inheritDoc}
     */
    public function setData(string $attribute, mixed $value): static
    {
        $this->__set($attribute, $value);

        return $this;
    }

    // ? Protected Methods
    /**
     * Model fillable mutator
     *
     * @return array
     */
    protected function mutateFillable(): array
    {
        return tbauthmodeluserfillables();
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
    public function getEmail(): ?string
    {
        return $this->__get(self::ATTRIBUTE_EMAIL);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailVerifiedAt(): ?string
    {
        return $this->__get(self::ATTRIBUTE_EMAIL_VERIFIED_AT);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername(): ?string
    {
        return $this->__get(self::ATTRIBUTE_USERNAME);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(): ?string
    {
        return $this->__get(self::ATTRIBUTE_PASSWORD);
    }

    /**
     * {@inheritDoc}
     */
    public function getClassModel(): User
    {
        return $this->classModel;
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenExpiresAt(): ?Carbon
    {
        return $this->tokenExpiresAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): ?string
    {
        return $this->__get(self::ATTRIBUTE_CREATEDAT);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt(): ?string
    {
        return $this->__get(self::ATTRIBUTE_UPDATEDAT);
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
    public function setEmail(string $email): self
    {
        $this->__set(self::ATTRIBUTE_EMAIL, $email);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailVerifiedAt(string $emailVerifiedAt): self
    {
        $this->__set(self::ATTRIBUTE_EMAIL_VERIFIED_AT, $emailVerifiedAt);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername(string $username): self
    {
        $this->__set(self::ATTRIBUTE_USERNAME, $username);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password): self
    {
        $this->__set(self::ATTRIBUTE_PASSWORD, $password);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setClassModel(User $user): self
    {
        $this->classModel = $user;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokenExpiresAt(Carbon $tokenExpiresAt): self
    {
        $this->tokenExpiresAt = $tokenExpiresAt;

        return $this;
    }
}
