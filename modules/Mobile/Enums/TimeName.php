<?php

namespace Modules\Mobile\Enums;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

enum TimeName: string
{
    /**
     * Regional timezone "Asia/Ho_Chi_Minh" sorts as "VN"
     */
    case BaseTimeZone = 'Asia/Ho_Chi_Minh';

    /**
     * @param string $locale
     * @return string
     */
    public static function getTimezone(string $locale): string
    {
        $configTimeZone = config('mobile.timezone');
        if (empty($configTimeZone)) {
            return self::BaseTimeZone->value;
        }

        //@phpstan-ignore-next-line
        return collect($configTimeZone)->firstWhere('countryCode', Str::upper($locale))['name'] ?? self::BaseTimeZone->value;
    }

    /**
     * @return Collection<string, mixed>
     */
    public static function listTimezone(): Collection
    {
        $configTimeZone = config('mobile.timezone');

        //@phpstan-ignore-next-line
        return collect($configTimeZone)->map(fn($item) => collect($item)
            ->only(['name', 'countryCode', 'countryName', 'rawFormat'])
            ->all())->keyBy('countryCode');
    }
}
