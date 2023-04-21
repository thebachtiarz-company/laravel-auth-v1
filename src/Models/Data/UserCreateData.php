<?php

namespace TheBachtiarz\Auth\Models\Data;

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;

class UserCreateData extends AbstractUserData implements UserCreateDataInterface
{
    //

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPassword(tbconfigvalue(AuthConfigInterface::CONFIG_NAME . '.default_user_password'));
    }
}
