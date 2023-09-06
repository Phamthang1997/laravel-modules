<?php

declare(strict_types=1);

namespace App\Traits\Provider;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

trait HasModuleProvider
{
    public string|null $rootDir = __DIR__;
    public string|null $moduleName = null;

    /**
     * Set root dir
     *
     * @param string $dir
     * @return static
     */
    public function setRootDir(string $dir): static
    {
        $this->rootDir = $dir;

        return $this;
    }

    /**
     * Get current module route file path
     *
     * @param string $fileName
     * @return string|null
     */
    public function getRouteFilePath(string $fileName): ?string
    {
        return $this->getCurrentModuleFullPath($this->getModuleName()) . $this->getModuleRouteDirName() . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Get current module name
     *
     * @return string|null
     */
    public function getModuleName(): ?string
    {
        if (!is_string($this->moduleName)) {
            $this->moduleName = $this->getModuleNameFromPath($this->rootDir);
        }

        return ($this->moduleName);
    }

    /**
     * Get current module full path
     *
     * @param string|null $moduleName
     * @return ?string
     */
    public function getCurrentModuleFullPath(?string $moduleName): ?string
    {
        return $this->getModulePath() . DIRECTORY_SEPARATOR. "$moduleName" .DIRECTORY_SEPARATOR;
    }

    /**
     * Get current module name within current provider call
     *
     * @param string|null $path
     * @return ?string
     */
    public function getModuleNameFromPath(?string $path): ?string
    {
        $modulePath = !empty($this->getModulePath()) ? $this->getModulePath() : '';
        $path = !empty($path) ? $path : '';
        $dirNames = array_filter(explode(DIRECTORY_SEPARATOR, str_replace($modulePath, '', $path)));
        if (empty($dirNames)) {
            return '';
        }

        return reset($dirNames);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function bootModule(): void
    {
        $directories = array_map('basename', File::directories($this->getModulePath()));
        foreach ($directories as $moduleName) {
            $this->registerModule($moduleName);
        }
    }

    /**
     * Register module dependency, routes should be registered within provider for each module
     *
     * @param string $moduleName
     * @return void
     */
    private function registerModule(string $moduleName): void
    {
        $modulePath = $this->getModulePath() . DIRECTORY_SEPARATOR. "$moduleName" .DIRECTORY_SEPARATOR;
        $this->registerLang($modulePath, $moduleName);
        $this->registerConfigs($modulePath, $moduleName);
        $this->registerView($modulePath, $moduleName);
        $this->registerMigration($modulePath);
    }

    /**
     * Register languages from current module path
     *
     * @param string $modulePath
     * @param string $moduleName
     * @return void
     */
    private function registerLang(string $modulePath, string $moduleName): void
    {
        $langPath = $modulePath . $this->getModuleLangDirName();
        if (!File::exists($langPath)) {
            return;
        }

        $this->loadTranslationsFrom($langPath, mb_strtolower($moduleName));
        $this->loadJSONTranslationsFrom($langPath);
    }

    /**
     * Register view from current module path
     *
     * @param string $modulePath
     * @param string $moduleName
     * @return void
     */
    private function registerView(string $modulePath, string $moduleName): void
    {
        $viewPath = $modulePath . $this->getModuleViewDirName();
        if (!File::exists($viewPath)) {
            return;
        }

        $this->loadViewsFrom($viewPath, mb_strtolower($moduleName));
    }

    /**
     * Register routes from current module path
     *
     * @param string $modulePath
     * @param string $moduleName
     * @return void
     */
    private function registerConfigs(string $modulePath, string $moduleName): void
    {
        $configPath = $modulePath . $this->getModuleConfigDirName();
        if (!File::exists($configPath)) {
            return;
        }
        $files = $this->getFilesByDir($configPath);
        if (empty($files)) {
            return;
        }
        $namespace = mb_strtolower($moduleName);
        foreach ($files as $filePath) {
            $fileName = basename($filePath, '.php');
            $alias = $namespace . '.' . $fileName;
            $this->mergeConfigFrom($filePath, $alias);
        }
    }

    /**
     * Get all php file within given directory
     *
     * @param string $directory
     * @param boolean $pathOnly
     * @return array<string>
     */
    public function getFilesByDir(string $directory, bool $pathOnly = true): array
    {
        $allFile = File::files($directory);
        //@phpstan-ignore-next-line
        return array_filter(array_map(function ($item) use ($pathOnly) {
            if (!($item instanceof SplFileInfo) || $item->getExtension() !== 'php') {
                return null;
            }
            if ($pathOnly) {
                return $item->getRealPath();
            }

            return $item;
        }, $allFile));
    }

    /**
     * Register view from current module path
     *
     * @param string $modulePath
     * @return void
     */
    private function registerMigration(string $modulePath): void
    {
        $migrationPath = $modulePath . $this->getModuleMigrationsDirName();
        if (!File::exists($migrationPath)) {
            return;
        }

        $this->loadMigrationsFrom($migrationPath);
    }

    /**
     * Get modules path
     *
     * @return string
     */
    public function getModulePath(): string
    {
        return base_path() . DIRECTORY_SEPARATOR . $this->getModuleDirName();
    }

    /**
     * Get module directory name
     *
     * @return string
     */
    public function getModuleDirName(): string
    {
        return 'modules';
    }

    /**
     * Get module language directory name
     *
     * @return string
     */
    private function getModuleLangDirName(): string
    {
        return 'Lang';
    }

    /**
     * Get module view directory name
     *
     * @return string
     */
    private function getModuleViewDirName(): string
    {
        return 'Views';
    }

    /**
     * Get module route directory name
     *
     * @return string
     */
    private function getModuleRouteDirName(): string
    {
        return 'Routes';
    }

    /**
     * Get module config directory name
     *
     * @return string
     */
    private function getModuleConfigDirName(): string
    {
        return 'Configs';
    }

    /**
     * Get module config directory name
     *
     * @return string
     */
    private function getModuleMigrationsDirName(): string
    {
        return 'Database' . DIRECTORY_SEPARATOR .'Migrations';
    }
}
