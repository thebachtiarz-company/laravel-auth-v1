<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Models\Data;

use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;

use function tbauthconfig;

class UserCreateData extends AbstractUserData implements UserCreateDataInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPassword(tbauthconfig('default_user_password', false));
    }
}
