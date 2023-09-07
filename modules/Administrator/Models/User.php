<?php

namespace Modules\Administrator\Models;

use App\Models\User as BaseUser;
use Illuminate\Contracts\Auth\CanResetPassword;
use Modules\Administrator\Email\Password\Forgot;

class User extends BaseUser implements CanResetPassword
{
    /**
     *
     * The table associated with the model.
     *
     */
    protected $table = 'administrator';

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new Forgot($token));
    }
}
