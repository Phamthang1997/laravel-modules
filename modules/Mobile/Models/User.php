<?php

namespace Modules\Mobile\Models;

use App\Models\User as BaseUser;
use Modules\Sanctum\Traits\HasSanctumTokens;
use Modules\Sanctum\Models\PersonalAccessToken;

class User extends BaseUser
{
    use HasSanctumTokens;

    /**
     * @return string
     */
    public function userTokenClass(): string
    {
        return PersonalAccessToken::class;
    }
}
