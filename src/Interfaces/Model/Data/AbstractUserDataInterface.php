<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface AbstractUserDataInterface
{
    public const ATTRIBUTE_IDENTIFIER = 'identifier';
    public const ATTRIBUTE_PASSWORD   = 'password';

    // ? Public Methods

    /**
     * Get data
     */
    public function getData(string|null $attribute = null): mixed;

    // ? Getter Modules

    /**
     * Get identifier
     */
    public function getIdentifier(): string|null;

    /**
     * Get password
     */
    public function getPassword(bool $hashed = true): string|null;

    // ? Setter Modules

    /**
     * Set identifier
     *
     * @return static
     */
    public function setIdentifier(string $identifier): static;

    /**
     * Set password
     *
     * @return static
     */
    public function setPassword(string $password): static;
}
