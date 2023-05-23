<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models\Data;

use Illuminate\Support\Facades\Hash;
use TheBachtiarz\Auth\Interfaces\Model\Data\AbstractUserDataInterface;

abstract class AbstractUserData implements AbstractUserDataInterface
{
    /**
     * Data
     *
     * @var array
     */
    protected array $data = [];

    public function getData(string|null $attribute = null): mixed
    {
        return @$this->data[$attribute] ?? $this->data;
    }

    public function getIdentifier(): string|null
    {
        return @$this->data[self::ATTRIBUTE_IDENTIFIER];
    }

    public function getPassword(bool $hashed = true): string|null
    {
        if (@$this->data[self::ATTRIBUTE_PASSWORD]) {
            return $hashed ? Hash::make($this->data[self::ATTRIBUTE_PASSWORD]) : $this->data[self::ATTRIBUTE_PASSWORD];
        }

        return null;
    }

    public function setIdentifier(string $identifier): static
    {
        $this->data[self::ATTRIBUTE_IDENTIFIER] = $identifier;

        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->data[self::ATTRIBUTE_PASSWORD] = $password;

        return $this;
    }
}
