<?php

namespace App\Enums;

use Illuminate\Support\Str;
use Throwable;

enum ModulesPrefix: string
{
    case Administrator = 'management';
    case Customer = 'customer';
    case Mobile = 'mobile';

    /**
     * get Modules Name from route prefix
     *
     * @param string $prefix
     * @return string
     */
    public static function getModulesName(string $prefix): string
    {
        try {
            $modulesName = self::tryFrom($prefix);
            if (empty($modulesName)) {
                return Str::lower(self::Administrator->value);
            }

            return Str::lower($modulesName->value);
        } catch (Throwable) {
            return Str::lower(self::Administrator->value);
        }
    }
}
