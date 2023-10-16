<?php

declare(strict_types=1);

namespace App\Traits\Provider;

use App\Http\Middleware\AllowCors;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;
use Symfony\Component\Finder\SplFileInfo;

trait HasRouteProvider
{
    /**
     * Define your middlewares module.
     * @var array<string>
     */
    protected array $middlewaresModule = [];

    /**
     * Define your after auth middlewares module.
     * @var array<string>
     */
    protected array $middlewareAuth = [];

    private bool $isPrefix = false;

    /**
     * Get route prefix for current module
     *
     * @param string $moduleName
     * @param mixed|null $extraPath
     * @return string
     */
    public function getRoutePrefix(string $moduleName, mixed $extraPath = null): string
    {
        $routePrefix = config($moduleName . '.commons.route_prefix');
        if (!is_string($routePrefix)) {
            $routePrefix = $moduleName;
        }
        if (empty($extraPath)) {
            return $routePrefix;
        }

        return $routePrefix . '/' . $extraPath;
    }

    /**
     * Register route by route file path
     *
     * @param array<string> $middlewares
     * @param string $prefix
     * @param string $filePath
     * @return void
     */
    private function registerRouteFromPath(array $middlewares, string $prefix, string $filePath): void
    {
        $routePrefix = $prefix;
        if ($this->isPrefix) {
            $routePrefix = '';
        }

        if (File::exists($filePath)) {
            Route::middleware($middlewares)->prefix($routePrefix)->as($prefix.'.')
                ->group($filePath);
        }
    }

    /**
     * Register route by directory
     *
     * @param array<string> $middlewares
     * @param string $prefix
     * @param mixed $filePaths
     * @return void
     */
    private function registerRouteFromPaths(array $middlewares, string $prefix, mixed $filePaths): void
    {
        if (empty($filePaths)) {
            return;
        }
        if (is_string($filePaths)) {
            $filePaths = [$filePaths];
        }
        $middlewares = array_merge($middlewares, [AllowCors::class]);
        foreach ((array) $filePaths as $filePath) {
            $this->registerRouteFromPath($middlewares, $prefix, $filePath);  /** @phpstan-ignore-line */
        }
    }

    /**
     * Register tenant route resolved by path
     *
     * @param array<string> $middlewares
     * @param string $prefix
     * @param mixed $filePaths
     * @return boolean
     */
    public function registerModuleRouteFromPaths(array $middlewares, string $prefix, mixed $filePaths): bool
    {

        $middlewaresPath = $this->getModuleDirName(). DIRECTORY_SEPARATOR. $this->getModuleName(). DIRECTORY_SEPARATOR. $this->getHttpMiddlewaresDirName();
        $this->mappingMiddlewares($middlewaresPath . $this->getGlobalMiddlewaresDirName());
        // add resolve middleware by path
        if (!empty($this->middlewaresModule)) {
            $middlewares = array_merge($this->middlewaresModule, $middlewares);
        }
        // add resolve after auth middleware by path
        if (!empty($this->middlewareAuth)) {
            $middlewares = array_merge($middlewares, $this->middlewareAuth);
        }
        $this->registerRouteFromPaths($middlewares, $prefix, $filePaths);

        return true;
    }

    /**
     * Set isPrefix
     *
     * @param bool $isPrefix
     * @return bool
     */
    public function setIsPrefix(bool $isPrefix): bool
    {
        $this->isPrefix = $isPrefix;

        return $this->isPrefix;
    }

    /**
     * @param string $basePath
     * @return void
     */
    private function mappingMiddlewares(string $basePath): void
    {
        $this->getFolderFiles($basePath)->each(
            fn (array $files, string $actualFolder) => LazyCollection::make($files)->each(
                function (SplFileInfo $file) use ($actualFolder) {
                    $filenameWithoutExtension = $file->getFilenameWithoutExtension();
                    $filePath = str_replace($this->getModulePath(), '', $file->getPath());
                    $concreteFrom = $this->middlewareFrom($filePath, $filenameWithoutExtension);

                    if (!class_exists($concreteFrom)) {
                        return;
                    }

                    match (true) { /** @phpstan-ignore-line */
                         str_contains($this->getBeforeMiddlewaresDirName(), $actualFolder) => array_push($this->middlewaresModule, $concreteFrom),
                         str_contains($this->getAfterMiddlewaresDirName(), $actualFolder) => array_push($this->middlewareAuth, $concreteFrom),
                    };
                }
            )
        );
    }

    /**
     * Get the folder files except for ignored ones.
     *
     * @return LazyCollection<string, array<SplFileInfo>>
     */
    private function getFolderFiles(string $basePath): LazyCollection
    {
        return LazyCollection::make(File::directories(base_path($basePath)))
            ->mapWithKeys(fn (string $folder) => [basename($folder) => File::allFiles($folder)]);
    }

    /**
     * Get the namespace from a given path.
     *
     * @param string $path
     *
     * @return string
     */
    private function namespaceFrom(string $path): string
    {
        //@phpstan-ignore-next-line
        return str($path)->replace('/', '\\')->ucfirst()->value();
    }


    /**
     * Get the concrete from filename.
     *
     * @param string $folder
     * @param string $filenameWithoutExtension
     * @return string
     */
    private function middlewareFrom(string $folder, string $filenameWithoutExtension): string
    {
        $nameSpace = $this->getModuleDirName() . $folder  . '\\' . $filenameWithoutExtension;

        return $this->namespaceFrom($nameSpace);
    }

    /**
     *Get module before auth middlewares directory name
     *
     * @return string
     */
    private function getBeforeMiddlewaresDirName(): string
    {
        return 'BeforeFilter';
    }

    /**
     * Get module after auth middlewares directory name
     *
     * @return string
     */
    private function getAfterMiddlewaresDirName(): string
    {
        return 'AfterFilter';
    }

    /**
     * Get module http requests middlewares directory name
     *
     * @return string
     */
    private function getGlobalMiddlewaresDirName(): string
    {
        return 'Global' . DIRECTORY_SEPARATOR;
    }

    /**
     * Get module http requests middlewares directory name
     *
     * @return string
     */
    private function getHttpMiddlewaresDirName(): string
    {
        return 'Http' . DIRECTORY_SEPARATOR . 'Middleware' . DIRECTORY_SEPARATOR;
    }
}
