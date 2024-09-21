<?php

namespace App\Providers;

use App\Http\View\Composers\CountComposer;
use App\Models\Footer;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        View::composer('*', CountComposer::class);

        $footer = Footer::first();
        view()->share('footer', Footer::first());
    }
}
