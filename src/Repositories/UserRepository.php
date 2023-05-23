<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;

use function assert;
use function sprintf;
use function tbauthconfig;

class UserRepository extends AbstractRepository
{
    // ? Public Methods

    /**
     * Get user by id
     */
    public function getById(int $id): UserInterface
    {
        $user = User::find($id);

        if (! $user) {
            throw new ModelNotFoundException("User with id '$id' not found");
        }

        return $user;
    }

    /**
     * Get user by identifier
     */
    public function getByIdentifier(string $identifier): UserInterface
    {
        $user = User::getByIdentifier($identifier)->first();

        if (! $user) {
            throw new ModelNotFoundException(sprintf("User with %s '%s' not found", tbauthconfig(AuthConfigInterface::IDENTITY_METHOD), $identifier));
        }

        return $user;
    }

    /**
     * Create new user
     */
    public function create(UserInterface $userInterface): UserInterface
    {
        /** @var Model $userInterface */
        $create = $this->createFromModel($userInterface);
        assert($create instanceof UserInterface);

        if (! $create) {
            throw new ModelNotFoundException('Failed to create new user');
        }

        return $create;
    }

    /**
     * Update current user
     */
    public function save(UserInterface $userInterface): UserInterface
    {
        /** @var Model|UserInterface $userInterface */
        $user = $userInterface->save();

        if (! $user) {
            throw new ModelNotFoundException('Failed to save current user');
        }

        return $userInterface;
    }

    /**
     * Delete user by id
     */
    public function deleteById(int $id): bool
    {
        $user = $this->getById($id);
        assert($user instanceof Model);

        return $user->delete();
    }

    /**
     * Delete user by identifier
     */
    public function deleteByIdentifier(string $identifier): bool
    {
        $user = $this->getByIdentifier($identifier);
        assert($user instanceof Model || $user instanceof UserInterface);

        return $this->deleteById($user->getId());
    }

    // ? Private Methods

    // ? Setter Modules
}
