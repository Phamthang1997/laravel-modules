<?php

declare(strict_types=1);

namespace Modules\Sanctum\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\Sanctum\Enums\TokenType;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\PersonalAccessToken as BaseAccessToken;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PersonalAccessToken extends BaseAccessToken
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at',
        'token_type',
        'access_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'id',
        'tokenable_type',
        'tokenable_id',
        'abilities',
        'last_used_at',
        'name',
        'access_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    public static string $rememberMeKey = 'remember_me';

    /**
     * @param TokenType $type
     * @return Carbon
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getTokenExpired(TokenType $type): Carbon
    {
        $lifeTime = $this->tokenLifeTime()[$type->value];
        if ($this->rememberMe()) {
            $lifeTime *= config('sanctum.token.lifetime.remember_me_ratio'); // ratio x30 days
        }

        return Carbon::now()->addMinutes(intval($lifeTime)); // @phpstan-ignore-line
    }

    /**
     * Check if remember me
     *
     * @return boolean
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function rememberMe(): bool
    {
        return !!request()->get(self::$rememberMeKey); // @phpstan-ignore-line
    }


    /**
     * Token lifetime
     *
     * @return array<string, mixed>>
     */
    protected function tokenLifeTime(): array
    {
        return [
            TokenType::Access->value => config('sanctum.token.lifetime.access'), // 1 hour
            TokenType::Refresh->value => config('sanctum.token.lifetime.refresh'), // 1 day
        ];
    }

    /**
     * Scope for valid tokens
     *
     * @param Builder $query
     * @return void
     */
    public function scopeValid(Builder $query): void
    {
        $query->where('expires_at', '>', Carbon::now());
    }

    /**
     * Check if expires_at valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        // no expires at
        if (!isset($this->expires_at)) {
            return true;
        }

        return !$this->expires_at->isPast();
    }

    /**
     * Save token as Refresh Token
     *
     * @param array<string> $abilities
     * @return array<string>
     * @throws \Throwable
     */
    public function updateAsRefreshToken(array $abilities ,): array
    {
        return $this->updateToken($abilities, TokenType::Refresh);
    }

    /**
     * Save token
     *
     * Save token as Access Token
     * @param array<string> $abilities
     * @return array<string>
     * @throws \Throwable
     */
    public function updateAsAccessToken(array $abilities): array
    {
        return $this->updateToken($abilities, TokenType::Access);
    }

    /**
     * Save token
     *
     * @param array<string> $abilities
     * @param TokenType $type
     * @return array<string>
     * @throws \Throwable
     */
    public function updateToken(array $abilities, TokenType $type): array
    {
        $plainTextToken = Str::random($type->value == TokenType::Access->value ? 40 : 100);
        $this->updateOrFail([
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $this->getTokenExpired($type),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'token_type' => $type->value,
            'access_id' => $type->value == TokenType::Access->value ? null : $this->access_id, // @phpstan-ignore-line
        ]);
        $token = $this->refresh();
        // update expires at refresh token
        if ($type->value == TokenType::Access->value) {
            /** @phpstan-ignore-next-line */
            $refreshToken = $this->where('access_id', $token->id)->first();
            $refreshToken->update(['expires_at' => $this->getTokenExpired(TokenType::Refresh)]);
        }

        return [
            'accessToken' => $token->token, // @phpstan-ignore-line
            'plainTextToken' => $token->getKey().'|'.$plainTextToken,
            'expiresAt' => Carbon::parse($token->expires_at)->timestamp, // @phpstan-ignore-line
        ];
    }


    /**
     * updateFullToken
     *
     * @param array<string> $abilities
     * @return array<string>
     * @throws \Throwable
     */
    public function updatePersonalToken(array $abilities = ['*']): array
    {
        $accessToken = $this->updateAsAccessToken($abilities);

        return [
            'accessToken' => $accessToken['plainTextToken'],
            'expiresAt' => $accessToken['expiresAt'],
        ];
    }
}
