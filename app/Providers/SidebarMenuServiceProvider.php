<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;

class SidebarMenuServiceProvider extends ServiceProvider
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
        Facades\View::composer('layouts.partial.sidebar', function (View $view)
        {
            $role = Auth::user()->role;
            $menus = $role->getMenusSubjectToRole();

            $view->with('menus', $menus);
        });
    }
}
