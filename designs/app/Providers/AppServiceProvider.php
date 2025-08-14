<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ClickHouseDB\Client;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton(
            Client::class,
            static function () {
                return new Client([
                    'host'     => config('api.clickhouse.host'),
                    'port'     => config('api.clickhouse.port'),
                    'username' => config('api.clickhouse.username'),
                    'password' => config('api.clickhouse.password'),
                ]);
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
