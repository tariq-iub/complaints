<?php

namespace App\Providers;

use App\Models\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class TopbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('layouts.partial.topbar', function (View $view)
        {
            $view->with('factories', Factory::with('sites')->get());
        });
    }
}
