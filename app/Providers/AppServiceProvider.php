<?php

namespace App\Providers;

use App\Interface\ClienteRepositoryInterface;
use App\Interface\ClienteServiceInterface;
use App\Repository\ClienteRepository;
use App\Services\ClienteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ClienteServiceInterface::class,
            ClienteService::class
        );

        $this->app->bind(
            ClienteRepositoryInterface::class,
            ClienteRepository::class
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
