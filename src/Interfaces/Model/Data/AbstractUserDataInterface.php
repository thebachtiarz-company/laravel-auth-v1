<?php

namespace TheBachtiarz\Auth\Interfaces\Model\Data;

interface AbstractUserDataInterface
{
    public const ATTRIBUTE_IDENTIFIER = 'identifier';
    public const ATTRIBUTE_PASSWORD = 'password';

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
     * @return self
     */
    public function setIdentifier(string $identifier): self;

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self;
}
