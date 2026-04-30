<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(
        \App\Interfaces\UserRepositoryInterface::class,
        \App\Repositories\UserRepository::class
    );

    $this->app->bind(
        \App\Interfaces\StudentRepositoryInterface::class,
        \App\Repositories\StudentRepository::class
    );


    $this->app->bind(
        \App\Interfaces\CompanyRepositoryInterface::class,
        \App\Repositories\CompanyRepository::class
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
