<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\User;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    //

    // ? Public Methods
    /**
     * Get user by id
     *
     * @param integer $id
     * @return UserInterface
     */
    public function getById(int $id): UserInterface
    {
        $_user = User::find($id);

        if (!$_user) throw new ModelNotFoundException("User with id '$id' not found");

        return $_user;
    }

    /**
     * Get user by identifier
     *
     * @param string $identifier
     * @return UserInterface
     */
    public function getByIdentifier(string $identifier): UserInterface
    {
        $_user = User::getByIdentifier($identifier)->first();

        if (!$_user) throw new ModelNotFoundException(sprintf("User with %s '%s' not found", tbauthconfig(AuthConfigInterface::IDENTITY_METHOD), $identifier));

        return $_user;
    }

    /**
     * Create new user
     *
     * @param UserInterface $userInterface
     * @return UserInterface
     */
    public function create(UserInterface $userInterface): UserInterface
    {
        /** @var Model $userInterface */
        /** @var UserInterface $_create */
        $_create = $this->createFromModel($userInterface);

        if (!$_create) throw new ModelNotFoundException("Failed to create new user");

        return $_create;
    }

    /**
     * Update current user
     *
     * @param UserInterface $userInterface
     * @return UserInterface
     */
    public function save(UserInterface $userInterface): UserInterface
    {
        /** @var Model|UserInterface $userInterface */
        $_user = $userInterface->save();

        if (!$_user) throw new ModelNotFoundException("Failed to save current user");

        return $userInterface;
    }

    /**
     * Delete user by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        /** @var Model|UserInterface $_user */
        $_user = $this->getById($id);

        return $_user->delete();
    }

    /**
     * Delete user by identifier
     *
     * @param string $identifier
     * @return boolean
     */
    public function deleteByIdentifier(string $identifier): bool
    {
        /** @var Model|UserInterface $_user */
        $_user = $this->getByIdentifier($identifier);

        return $this->deleteById($_user->getId());
    }

    // ? Private Methods

    // ? Setter Modules
}
