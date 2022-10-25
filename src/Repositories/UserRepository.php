<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Models\User;

class UserRepository
{
    //

    // ? Public Methods
    /**
     * Get user by id
     *
     * @param integer $id
     * @return User
     */
    public function getById(int $id): User
    {
        $_user = User::find($id);

        if (!$_user) throw new ModelNotFoundException("User with id '$id' not found");

        return $_user;
    }

    /**
     * Create new user
     *
     * @param User $user
     * @return User
     */
    public function create(User $user): User
    {
        $_data = [];

        foreach ($user->getFillable() as $key => $attribute) {
            $_data[$attribute] = $user->__get($attribute);
        }

        $_create = User::create($_data);

        if (!$_create) throw new ModelNotFoundException("Failed to create new user");

        return $_create;
    }

    /**
     * Update current user
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $_user = $user->save();

        if (!$_user) throw new ModelNotFoundException("Failed to save current user");

        return $user;
    }

    /**
     * Delete user by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        $_user = $this->getById($id);

        $_delete = $_user->delete();

        if (!$_delete) throw new ModelNotFoundException("Failed to delete user with id '$id'");

        return $_delete;
    }

    // ? Private Methods

    // ? Setter Modules
}
