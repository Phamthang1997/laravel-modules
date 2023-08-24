<?php

namespace Modules\Mobile\Enums;

use Illuminate\Support\Collection;

enum Language: string
{
    /**
     * @return Collection<int, mixed>
     */
    public static function listLanguage(): Collection
    {
        $configLanguage = config('mobile.localization');

        //@phpstan-ignore-next-line
        return collect($configLanguage)->map(fn($item) => collect($item)
            ->only(['name', 'native', 'regional'])
            ->all());
    }
}
