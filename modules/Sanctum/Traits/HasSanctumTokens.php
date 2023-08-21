<?php

namespace Modules\Sanctum\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\Sanctum\Enums\TokenType;
use Modules\Sanctum\Models\PersonalAccessToken;
use Illuminate\Contracts\Container\BindingResolutionException;

trait HasSanctumTokens
{
    use HasApiTokens;

    protected ?int $access_id = null;

    /**
     * createRefreshToken
     *
     * @param string $token
     * @param array<string> $abilities
     * @return array<string>
     * @throws BindingResolutionException
     */
    public function createRefreshToken(string $token, array $abilities = ['*']): array
    {
        return $this->createToken($token, $abilities, TokenType::Refresh);
    }

    /**
     * createAccessToken
     *
     * @param string $token
     * @param array<string> $abilities
     * @return array<string>
     * @throws BindingResolutionException
     */
    public function createAccessToken(string $token, array $abilities = ['*']): array
    {
        return $this->createToken($token, $abilities, TokenType::Access);
    }

    /**
     * createFullToken
     *
     * @param string $token
     * @param array<string> $abilities
     * @return array<string>
     * @throws BindingResolutionException
     */
    public function createPersonalToken(string $token, array $abilities = ['*']): array
    {
        $accessToken = $this->createAccessToken($token, $abilities);
        $refreshToken = $this->createRefreshToken($token, $abilities);

        return [
            'accessToken' => $accessToken['plainTextToken'],
            'expiresAt' => $accessToken['expiresAt'],
            'refreshToken' => $refreshToken['plainTextToken'],
        ];
    }

    /**
     * @param string $name
     * @param array<string> $abilities
     * @param TokenType $type
     * @return array<string>
     * @throws BindingResolutionException
     */
    public function createToken(string $name, array $abilities = ['*'], TokenType $type = TokenType::Access): array
    {
        $instance = app()->make($this->userTokenClass()); /** @phpstan-ignore-line */
        $plainTextToken = Str::random(40);
        /** @var PersonalAccessToken $token */
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $instance->getTokenExpired($type),
            'token_type' => $type->value,
            'access_id' => !empty($this->access_id) ? $this->access_id : null,
        ]);
        $instance->refresh();
        //@phpstan-ignore-next-line
        $this->access_id = $token->id;

        return [
            'accessToken' => $token->token, /** @phpstan-ignore-line */
            'plainTextToken' => $token->getKey().'|'.$plainTextToken,
            'expiresAt' => Carbon::parse($token->expires_at)->timestamp, /** @phpstan-ignore-line */
        ];
    }

    /**
     * @return string
     */
    public function userTokenClass(): string
    {
        return '';
    }
}
