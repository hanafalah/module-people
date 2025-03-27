<?php

namespace Hanafalah\ModulePeople;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModulePeopleServiceProvider extends BaseServiceProvider
{
    /**
     * Registers the package's namespaces.
     *
     * @return $this
     */
    public function register()
    {
        $this->registerMainClass(ModulePeople::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*',
                // 'Namespace' => function () {
                //     $this->publishes([
                //         $this->getAssetPath('/database/migrations/data/tribes.php') => database_path('data/tribes.php'),
                //     ], 'data');
                // },
                'Services'  => function () {
                    $this->binds([
                        Contracts\ModulePeople::class => new ModulePeople
                    ]);
                }
            ]);
    }

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
