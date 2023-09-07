<?php

namespace Modules\Mobile\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Modules\Mobile\Enums\PasswordCode;
use Modules\Mobile\Models\User;
use Modules\Mobile\Services\Contracts\PasswordServiceInterface;
use Illuminate\Contracts\Auth\PasswordBroker;
use ReflectionMethod;

class PasswordService implements PasswordServiceInterface
{
    private PasswordBroker $brokers;

    public function __construct()
    {
        $this->brokers = Password::broker('mobile');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \ReflectionException
     */
    public function forgot(Request $request): mixed
    {
        $user = $this->brokers->getUser($request->only('email')); /** @phpstan-ignore-line */
        if (is_null($user)) {
            return Password::INVALID_USER;
        }
        if ($this->brokers->getRepository()->recentlyCreatedToken($user)) { /** @phpstan-ignore-line */
            return Password::RESET_THROTTLED;
        }
        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $email = $user->getEmailForPasswordReset();
        $this->brokers->getRepository()->delete($user);/** @phpstan-ignore-line */
        $token = $this->createNewToken();
        // get method DatabaseTokenRepository -> getTable()
        $method = new ReflectionMethod($this->brokers->getRepository(), 'getTable'); /** @phpstan-ignore-line */
        $method->invoke($this->brokers->getRepository())->insert($this->getPayload($email, $token)); /** @phpstan-ignore-line */

        return $token;
    }

    /**
     * @param string $token
     * @return string
     * @throws \ReflectionException
     */
    public function verify(string $token): string
    {
        $record = $this->exists($token);
        if (! ($record && ! $this->tokenExpired($record['created_at']))) {
            return Password::INVALID_TOKEN;
        }

        return 'mobile::passwords.verify';
    }

    /**
     * @param string $token
     * @param string $password
     * @return string
     * @throws \ReflectionException
     */
    public function reset(string $token, string $password): string
    {
        $user = $this->validateReset($token);
        /* @var User $user*/
        $user->forceFill(['password' => Hash::make($password)]); /** @phpstan-ignore-line */
        $user->save();  /** @phpstan-ignore-line */
        event(new PasswordReset($user));  /** @phpstan-ignore-line */
        $this->brokers->getRepository()->delete($user); /** @phpstan-ignore-line */

        return Password::PASSWORD_RESET;
    }

    /**
     * Build the record payload for the table.
     *
     * @param  string  $email
     * @param  string  $token
     * @return array<string>
     */
    private function getPayload(string $email, string $token): array
    {
        return ['email' => $email, 'token' => hash('sha256', $token), 'created_at' => new Carbon];
    }

    /**
     * Create a new token for the user.
     *
     * @return int<100000, 999999>
     */
    private function createNewToken(): int
    {
        return mt_rand(PasswordCode::Start->value, PasswordCode::End->value);
    }

    /**
     * Validate a password reset for the given credentials.
     *
     * @param string $token
     * @return CanResetPassword|string
     * @throws \ReflectionException
     */
    private function validateReset(string $token): mixed
    {
        $record = $this->exists($token);
        if (! ($record && ! $this->tokenExpired($record['created_at']))) {
            return Password::INVALID_TOKEN;
        }
        if (is_null($user = $this->brokers->getUser(['email' => $record['email']]))) { /** @phpstan-ignore-line */
            return Password::INVALID_USER;
        }

        return $user;
    }


    /**
     * @param string $token
     * @return array<string>
     * @throws \ReflectionException
     */
    private function exists(string $token): array
    {
        // get method DatabaseTokenRepository -> getTable()
        $method = new ReflectionMethod($this->brokers->getRepository(), 'getTable'); /** @phpstan-ignore-line */

        return (array) $method->invoke($this->brokers->getRepository()) /** @phpstan-ignore-line */
            ->where('token', hash('sha256', $token))->first();
    }

    /**
     * Determine if the token has expired.
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired(string $createdAt): bool
    {
        return Carbon::parse($createdAt)->addSeconds(60 * 60)->isPast();
    }
}
