<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Supplier;
use App\Models\Fabric;
use App\Observers\SupplierObserver;
use App\Observers\FabricObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Supplier::observe(SupplierObserver::class);
        Fabric::observe(FabricObserver::class);
    }
}
