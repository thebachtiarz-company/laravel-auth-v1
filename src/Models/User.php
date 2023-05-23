<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Traits\Model\UserScopeTrait;

use function tbauthmodeluserfillables;

class User extends AbstractUserModel implements UserInterface
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    use UserScopeTrait;

    protected $table = self::TABLE_NAME;

    protected $hidden = ['password'];

    /**
     * Define class model.
     * Override purposes.
     */
    protected self $classModel;

    /**
     * Define token expires at.
     *
     * example: \TheBachtiarz\Base\App\Helpers\CarbonHelper::dbGetFullDateAddHours(1) -> to add 1 hour after token created.
     */
    protected Carbon|null $tokenExpiresAt = null;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->classModel = $this;
        $this->fillable($this->mutateFillable());
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

    public function getEmail(): string|null
    {
        return $this->__get(self::ATTRIBUTE_EMAIL);
    }

    public function getEmailVerifiedAt(): string|null
    {
        return $this->__get(self::ATTRIBUTE_EMAIL_VERIFIED_AT);
    }

    public function getUsername(): string|null
    {
        return $this->__get(self::ATTRIBUTE_USERNAME);
    }

    public function getPassword(): string|null
    {
        return $this->__get(self::ATTRIBUTE_PASSWORD);
    }

    public function getClassModel(): User
    {
        return $this->classModel;
    }

    public function getTokenExpiresAt(): Carbon|null
    {
        return $this->tokenExpiresAt;
    }

    public function setEmail(string $email): self
    {
        $this->__set(self::ATTRIBUTE_EMAIL, $email);

        return $this;
    }

    public function setEmailVerifiedAt(string $emailVerifiedAt): self
    {
        $this->__set(self::ATTRIBUTE_EMAIL_VERIFIED_AT, $emailVerifiedAt);

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->__set(self::ATTRIBUTE_USERNAME, $username);

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->__set(self::ATTRIBUTE_PASSWORD, $password);

        return $this;
    }

    public function setClassModel(User $user): self
    {
        $this->classModel = $user;

        return $this;
    }

    public function setTokenExpiresAt(Carbon $tokenExpiresAt): self
    {
        $this->tokenExpiresAt = $tokenExpiresAt;

        return $this;
    }
}
