<?php

namespace TheBachtiarz\Auth\Models\Data;

use Illuminate\Support\Facades\Hash;
use TheBachtiarz\Auth\Interfaces\Model\Data\AbstractUserDataInterface;

abstract class AbstractUserData implements AbstractUserDataInterface
{
    //

    /**
     * Data
     *
     * @var array
     */
    protected array $data = [];

    // ? Public Methods
    /**
     * {@inheritDoc}
     */
    public function getData(?string $attribute = null): mixed
    {
        return @$this->data[$attribute] ?? $this->data;
    }

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getIdentifier(): ?string
    {
        return @$this->data[self::ATTRIBUTE_IDENTIFIER];
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(bool $hashed = true): ?string
    {
        if (@$this->data[self::ATTRIBUTE_PASSWORD]) {
            return $hashed ? Hash::make($this->data[self::ATTRIBUTE_PASSWORD]) : $this->data[self::ATTRIBUTE_PASSWORD];
        }

        return null;
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setIdentifier(string $identifier): static
    {
        $this->data[self::ATTRIBUTE_IDENTIFIER] = $identifier;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password): static
    {
        $this->data[self::ATTRIBUTE_PASSWORD] = $password;

        return $this;
    }
}