<?php

namespace Modules\Mobile\Enums;

use Illuminate\Support\Collection;

enum Separator: string
{
    /**
     * @return Collection<string, mixed>
     */
    public static function listNumber(): Collection
    {
        $configNumber = config('mobile.separator.number');

        //@phpstan-ignore-next-line
        return collect($configNumber);
    }

    /**
     * @return Collection<string, mixed>
     */
    public static function listTimestamp(): Collection
    {
        $configTimestamp = config('mobile.separator.timestamp');

        //@phpstan-ignore-next-line
        return collect($configTimestamp);
    }
}
