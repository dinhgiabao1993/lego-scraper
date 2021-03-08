<?php

namespace App\Providers;

use App\Repositories\RetiringSoonProductRepository;
use App\Repositories\RetiringSoonProductRepositoryInterface;
use App\Services\RetiringSoonProductService;
use App\Services\RetiringSoonProductServiceInterface;
use App\Services\ScraperService;
use App\Services\ScraperServiceInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScraperServiceInterface::class, ScraperService::class);
        $this->app->bind(RetiringSoonProductServiceInterface::class, RetiringSoonProductService::class);
        $this->app->bind(RetiringSoonProductRepositoryInterface::class, RetiringSoonProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
