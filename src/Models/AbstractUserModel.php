<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models;

use Illuminate\Foundation\Auth\User;
use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

abstract class AbstractUserModel extends User implements AbstractModelInterface
{
    public function getData(string $attribute): mixed
    {
        return $this->__get($attribute);
    }

    public function setData(string $attribute, mixed $value): static
    {
        $this->__set($attribute, $value);

        return $this;
    }

    public function getId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_ID);
    }

    public function getCreatedAt(): string|null
    {
        return $this->__get(self::ATTRIBUTE_CREATEDAT);
    }

    public function getUpdatedAt(): string|null
    {
        return $this->__get(self::ATTRIBUTE_UPDATEDAT);
    }

    public function setId(int $id): static
    {
        $this->__set(self::ATTRIBUTE_ID, $id);

        return $this;
    }
}
