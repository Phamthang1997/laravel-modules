<?php

namespace Modules\Customer\Models;

use App\Models\User as BaseUser;
use Illuminate\Contracts\Auth\CanResetPassword;
use Modules\Customer\Email\Password\Forgot;

class User extends BaseUser implements CanResetPassword
{
    /**
     *
     * The table associated with the model.
     *
     */
    protected $table = 'users';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new Forgot($token));
    }
}
