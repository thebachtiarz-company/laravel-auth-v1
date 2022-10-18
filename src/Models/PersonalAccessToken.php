<?php

namespace TheBachtiarz\Auth\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use TheBachtiarz\Auth\Traits\Model\{PersonalAccessTokenMapTrait, PersonalAccessTokenScopeTrait};

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use PersonalAccessTokenMapTrait, PersonalAccessTokenScopeTrait;
}
