<?php

namespace App\Traits\Provider\Contracts;

interface WithModuleProvider
{
    /**
     * Set root dir
     *
     * @param string $dir
     * @return static
     */
    public function setRootDir(string $dir): static;

    /**
     * Get current module route file path
     *
     * @param string $fileName
     * @return string|null
     */
    public function getRouteFilePath(string $fileName): ?string;

    /**
     * Get current module name
     *
     * @return string|null
     */
    public function getModuleName(): ?string;

    /**
     * Get current module full path
     *
     * @param string|null $moduleName
     * @return ?string
     */
    public function getCurrentModuleFullPath(?string $moduleName): ?string;

    /**
     * Get current module name within current provider call
     *
     * @param string|null $path
     * @return ?string
     */
    public function getModuleNameFromPath(?string $path): ?string;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function bootModule(): void;

    /**
     * Get all php file within given directory
     *
     * @param string $directory
     * @param boolean $pathOnly
     * @return array<string>
     */
    public function getFilesByDir(string $directory, bool $pathOnly = true): array;

    /**
     * Get modules path
     *
     * @return string
     */
    public function getModulePath(): string;

    /**
     * Get module directory name
     *
     * @return string
     */
    public function getModuleDirName(): string;
}
