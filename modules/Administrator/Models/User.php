<?php

namespace Modules\Administrator\Models;

use App\Models\User as BaseUser;

class User extends BaseUser
{
    /**
     *
     * The table associated with the model.
     *
     */
    protected $table = 'administrator';
}
