<?php

namespace App\Com\Providers;

use App\Logic\BasicCenter\Contract\UserContract;
use App\Logic\BasicCenter\Instance\UserRepository;
use Illuminate\Support\ServiceProvider;

class BasicCenterProvier extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserContract::class,
            UserRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            UserContract::class,
        ];
    }
}