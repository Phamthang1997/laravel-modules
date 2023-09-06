<?php

namespace App\Traits\Provider\Contracts;

interface WithRouteProvider
{
    /**
     * Get route prefix for current module
     *
     * @param string $moduleName
     * @param mixed|null $extraPath
     * @return string
     */
    public function getRoutePrefix(string $moduleName, mixed $extraPath = null): string;

    /**
     * Register tenant route resolved by path
     *
     * @param array<string> $middlewares
     * @param string $prefix
     * @param mixed $filePaths
     * @return boolean
     */
    public function registerModuleRouteFromPaths(array $middlewares, string $prefix, mixed $filePaths): bool;
}
