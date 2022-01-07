<?php

namespace Axeldotdev\Insee;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InseeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('insee')
            ->hasConfigFile('insee');
    }

    public function packageRegistered(): void
    {
        $this->app->bind('insee', function ($app) {
            return new Insee();
        });
    }
}
