<?php

declare(strict_types=1);

namespace App\Traits\Provider;

use Illuminate\Support\Facades\File;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use InvalidArgumentException;

trait HasContainerProvider
{

    /**
     * Subdirectories to ignore when scanning.
     *
     * @var array<string>
     */
    private array $excludesFolders = [];

    /**
     * Postfix convention for interfaces.
     *
     * @var string
     */
    private string $interfaceNaming = 'Interface';

    /**
     * Target class folder.
     *
     * @var string
     */
    private string $classFolder = '';

    /**
     * The type of bindings.
     *
     * @var string
     */
    private string $bindingType = 'singletonIf';


    /**
     * Register any application services <Services, Repositories>.
     *
     * @return void
     */
    public function registerContainer(): void
    {
        $modulePath = $this->getModuleDirName() . DIRECTORY_SEPARATOR. $this->getModuleName() . DIRECTORY_SEPARATOR;
        $this->registerServices($modulePath);
        $this->registerRepositories($modulePath);
    }

    /**
     * registerServices
     *
     * @param string $modulePath
     * @return void
     */
    private function registerServices(string $modulePath): void
    {
        $this->classFolder = $modulePath . $this->getModuleServicesDirName();
        $this->namespaceFrom($this->classFolder);
        $this->registerBinder();
    }

    /**
     * registerRepositories
     *
     * @param string $modulePath
     * @return void
     */
    private function registerRepositories(string $modulePath): void
    {
        $this->classFolder = $modulePath . $this->getModuleRepositoriesDirName();
        $this->namespaceFrom($this->classFolder);
        $this->registerBinder();
    }


    /**
     * Get the folder files except for ignored ones.
     *
     * @return LazyCollection<string, array<SplFileInfo>>
     */
    private function getFolderFiles(string $basePath): LazyCollection
    {
        return LazyCollection::make(File::directories(base_path($basePath)))
            ->reject(fn (string $folder) => in_array(basename($folder), $this->excludesFolders))
            ->mapWithKeys(fn (string $folder) => [basename($folder) => File::allFiles($folder)]);
    }

    /**
     * Run the directory scanning & bind the results.
     *
     * @return void
     */
    private function registerBinder(): void
    {
        $this->getFolderFiles($this->classFolder)->each(
            fn (array $files, string $actualFolder) => LazyCollection::make($files)->each(
                function (SplFileInfo $file) use ($actualFolder) {
                    $relativePath = $file->getRelativePathname();
                    $filenameWithoutExtension = $file->getFilenameWithoutExtension();
                    $filenameWithRelativePath = $this->prepareFilename($relativePath);

                    $interface = $this->interfaceFrom($filenameWithoutExtension);
                    $concrete = $this->concreteFrom($actualFolder, $filenameWithRelativePath);

                    if (! interface_exists($interface) || ! class_exists($concrete)) {
                         return;
                    }

                     app()->{$this->bindingType}($interface, $concrete);
                }
            )
        );
    }

    /**
     * Bind the result as a specific type of binding.
     *
     * @param  string  $type
     *
     * @return static
     */
    public function setBindingType(string $type): static
    {
        if (! Str::is(['bind', 'scoped', 'singleton', 'singletonIf'], $type)) {
            throw new InvalidArgumentException('Invalid binding type.');
        }
        $this->bindingType = $type;

        return $this;
    }

    /**
     * Get the namespace from a given path.
     *
     * @param string $path
     *
     * @return static
     */
    private function namespaceFrom(string $path): static
    {
        //@phpstan-ignore-next-line
        $this->classFolder = str($path)->replace('/', '\\')->ucfirst()->value();

        return $this;
    }

    /**
     * Prepare the filename.
     *
     * @param  string  $filename
     *
     * @return string
     */
    private function prepareFilename(string $filename): string
    {
        //@phpstan-ignore-next-line
        return str($filename)
            ->replace('/', '\\')
            ->substr(0, strrpos($filename, '.'))
            ->value();
    }

    /**
     * Get the interface from filename.
     *
     * @param  string  $filenameWithoutExtension
     *
     * @return string
     */
    private function interfaceFrom(string $filenameWithoutExtension): string
    {
        $guessedInterface = $this->guessInterfaceBy($filenameWithoutExtension);

        return ! is_null($guessedInterface)
            ? $guessedInterface
            : $this->buildInterfaceBy($filenameWithoutExtension);
    }

    /**
     * Get the concrete from filename.
     *
     * @param string $folder
     * @param string $filenameWithRelativePath
     * @return string
     */
    private function concreteFrom(string $folder, string $filenameWithRelativePath): string
    {
        //@phpstan-ignore-next-line
        return $this->classFolder . '\\' . $this->prepareActual($folder . '\\') . $this->prepareNamingFor($filenameWithRelativePath);
    }

    /**
     * Guess the interface with a given filename.
     *
     * @param  string  $filenameWithoutExtension
     *
     * @return string|null
     */
    private function guessInterfaceBy(string $filenameWithoutExtension): ?string
    {
        return ! Str::contains($this->getInterfaceNamespace(), '\\')
                ? $this->buildInterfaceFromClassBy($filenameWithoutExtension)
                : null;
    }

    /**
     * Build the interface class-string based on the class folder.
     *
     * @param string $filename
     *
     * @return string
     */
    private function buildInterfaceFromClassBy(string $filename): string
    {
        //@phpstan-ignore-next-line
        return $this->classFolder. '\\'
            . $this->getInterfaceNamespace() . '\\'
            . $this->prepareNamingFor($filename) . $this->interfaceNaming;
    }

    /**
     * Build the interface class-string.
     *
     * @param  string  $filename
     *
     * @return string
     */
    private function buildInterfaceBy(string $filename): string
    {
        //@phpstan-ignore-next-line
        return $this->getInterfaceNamespace() . '\\'
            . $this->prepareNamingFor($filename)
            . $this->interfaceNaming;
    }

    /**
     * Cleans up filename to append the desired interface name.
     *
     * @param string $filename
     *
     * @return string
     */
    private function prepareNamingFor(string $filename): string
    {
        //@phpstan-ignore-next-line
        return Str::replace($this->interfaceNaming, '', $filename);
    }

    /**
     * prepares an actual folder.
     *
     * @param string $folder
     *
     * @return string
     */
    private function prepareActual(string $folder): string
    {
        //@phpstan-ignore-next-line
        return Str::replace(Str::plural($this->getInterfaceNamespace()) . '\\', '', $folder);
    }

    /**
     * Get module services directory name
     *
     * @return string
     */
    public function getModuleServicesDirName(): string
    {
        return 'Services';
    }

    /**
     * Get module repositories directory name
     *
     * @return string
     */
    public function getModuleRepositoriesDirName(): string
    {
        return 'Repositories';
    }

    /**
     * Get module interface directory name
     *
     * @return string
     */
    private function getInterfaceNamespace(): string
    {
        return "Contracts";
    }
}
