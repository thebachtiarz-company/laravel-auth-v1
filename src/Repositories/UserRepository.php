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
        $user = User::find($id);

        if (!$user) throw new ModelNotFoundException("User with id '$id' not found");

        return $user;
    }

    /**
     * Get user by identifier
     *
     * @param string $identifier
     * @return UserInterface
     */
    public function getByIdentifier(string $identifier): UserInterface
    {
        $user = User::getByIdentifier($identifier)->first();

        if (!$user) throw new ModelNotFoundException(sprintf("User with %s '%s' not found", tbauthconfig(AuthConfigInterface::IDENTITY_METHOD), $identifier));

        return $user;
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
        /** @var UserInterface $create */
        $create = $this->createFromModel($userInterface);

        if (!$create) throw new ModelNotFoundException("Failed to create new user");

        return $create;
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
        $user = $userInterface->save();

        if (!$user) throw new ModelNotFoundException("Failed to save current user");

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
        /** @var Model $user */
        $user = $this->getById($id);

        return $user->delete();
    }

    /**
     * Delete user by identifier
     *
     * @param string $identifier
     * @return boolean
     */
    public function deleteByIdentifier(string $identifier): bool
    {
        /** @var Model|UserInterface $user */
        $user = $this->getByIdentifier($identifier);

        return $this->deleteById($user->getId());
    }

    // ? Private Methods

    // ? Setter Modules
}
