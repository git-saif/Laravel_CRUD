<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        
        // শুধু active কোম্পানি নেবে
        $companySettings = Company::where('status', 'active')->first();

        // সব Blade view-এ share করবে
        View::share('companySettings', $companySettings);
    }
}
