<?php

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface AbstractUserDataInterface
{
    public const ATTRIBUTE_IDENTIFIER = 'identifier';
    public const ATTRIBUTE_PASSWORD = 'password';

    // ? Public Methods
    /**
     * Get data
     *
     * @param string|null $attribute
     * @return mixed
     */
    public function getData(?string $attribute = null): mixed;

    // ? Getter Modules
    /**
     * Get identifier
     *
     * @return string|null
     */
    public function getIdentifier(): ?string;

    /**
     * Get password
     *
     * @param boolean $hashed
     * @return string|null
     */
    public function getPassword(bool $hashed = true): ?string;

    // ? Setter Modules
    /**
     * Set identifier
     *
     * @param string $identifier
     * @return static
     */
    public function setIdentifier(string $identifier): static;

    /**
     * Set password
     *
     * @param string $password
     * @return static
     */
    public function setPassword(string $password): static;
}
