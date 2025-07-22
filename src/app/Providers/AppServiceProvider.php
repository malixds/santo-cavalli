<?php

namespace App\Providers;

use App\Interfaces\CartInterfaces\ICartRepository;
use App\Interfaces\CollectionInterfaces\ICollectionRepository;
use App\Repository\CartRepositories\CartRepository;
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
        $this->app->bind(ICartRepository::class, CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
