<?php

declare(strict_types=1);

namespace Modules\Sanctum\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Sanctum\Enums\TokenType;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\PersonalAccessToken as BaseAccessToken;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @method static \Illuminate\Database\Query\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder create(array $attributes = [])
 * @method static Builder findOrFail($id, $columns = ['*'])
 * @method Model update(array $attributes = [])
 *
 * @property int $id
 * @property string $token
 * @property int|null $access_id
 * @property CarbonInterface|Carbon|string $expires_at
 */
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

        return !$this->expires_at->isPast();/** @phpstan-ignore-line */
    }

    /**
     * Save token as Refresh Token
     *
     * @param array<string> $abilities
     * @return array<string, float|int|string>
     * @throws \Throwable
     */
    public function updateAsRefreshToken(array $abilities): array
    {
        return $this->updateToken($abilities, TokenType::Refresh);
    }

    /**
     * Save token
     *
     * Save token as Access Token
     * @param array<string> $abilities
     * @return array<string, float|int|string>
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
     * @return array<string, float|int|string>
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
            'access_id' => $type->value == TokenType::Access->value ? null : $this->access_id,
        ]);
        $token = $this->refresh();
        // update expires at refresh token
        if ($type->value == TokenType::Access->value) {
            /* @var PersonalAccessToken $refreshToken */
            $refreshToken = $this->where('access_id', $token->id)->first();
            $refreshToken?->update(['expires_at' => $this->getTokenExpired(TokenType::Refresh)]);/** @phpstan-ignore-line */
        }

        return [
            'accessToken' => $token->token,
            'plainTextToken' => $token->getKey().'|'.$plainTextToken,
            'expiresAt' => Carbon::parse($token->expires_at)->timestamp,
        ];
    }


    /**
     * updateFullToken
     *
     * @param array<string> $abilities
     * @return array<string, float|int|string>
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
