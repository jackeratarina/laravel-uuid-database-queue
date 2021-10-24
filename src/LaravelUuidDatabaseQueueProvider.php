<?php

namespace Stescacom\LaravelUuidDatabaseQueue;

use Illuminate\Support\ServiceProvider;

class LaravelUuidDatabaseQueueProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
