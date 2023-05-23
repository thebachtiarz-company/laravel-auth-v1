<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models;

use Illuminate\Support\Carbon;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Traits\Model\TokenResetScopeTrait;
use TheBachtiarz\Base\App\Models\AbstractModel;

class TokenReset extends AbstractModel implements TokenResetInterface
{
    use TokenResetScopeTrait;

    protected $table = self::TABLE_NAME;

    protected $fillable = self::ATTRIBUTES_FILLABLE;

    public function getToken(): string|null
    {
        return $this->__get(self::ATTRIBUTE_TOKEN);
    }

    public function getUserIdentifier(): string|null
    {
        return $this->__get(self::ATTRIBUTE_USERIDENTIFIER);
    }

    public function getExpiresAt(): string|null
    {
        return $this->__get(self::ATTRIBUTE_EXPIRESAT);
    }

    public function setToken(string $token): self
    {
        $this->__set(self::ATTRIBUTE_TOKEN, $token);

        return $this;
    }

    public function setUserIdentifier(string $userIdentifier): self
    {
        $this->__set(self::ATTRIBUTE_USERIDENTIFIER, $userIdentifier);

        return $this;
    }

    public function setExpiresAt(Carbon $expiresAt): self
    {
        $this->__set(self::ATTRIBUTE_EXPIRESAT, $expiresAt);

        return $this;
    }
}
