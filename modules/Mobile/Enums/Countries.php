<?php

namespace Modules\Mobile\Enums;

use Illuminate\Support\Collection;

enum Countries: string
{
    /**
     * @return Collection<string, mixed>
     */
    public static function listCountries(): Collection
    {
        $configCountries = config('mobile.countries');

        //@phpstan-ignore-next-line
        return collect($configCountries)->map(fn($item) => collect($item)
            ->only(['name', 'region', 'languages', 'translations', 'latlng', 'area', 'capital', 'currencies', 'borders', 'cca2'])
            ->all())->keyBy('cca2');
    }
}
