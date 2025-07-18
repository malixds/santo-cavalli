<?php

namespace App\Providers;

use App\Interfaces\CollectionInterfaces\ICollectionRepository;
use App\Repository\CollectionRepositories\CollectionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICollectionRepository::class, CollectionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
