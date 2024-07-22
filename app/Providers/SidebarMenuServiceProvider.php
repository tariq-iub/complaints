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
            $role = new Role();
            if (Auth::check() && $role->isSuperAdmin())
            {
                $view->with('menus', Menu::with('subMenus')
                    ->where('status', true)
                    ->whereNull('parent_id')
                    ->orderBy('display_order', 'asc')
                    ->get());
            }
            elseif (Auth::check() && $role->isAdmin())
            {
                $view->with('menus', Menu::with('subMenus')
                    ->where('status', true)
                    ->whereNull('parent_id')
                    ->where('level', 'admin')
                    ->orderBy('display_order', 'asc')
                    ->get());
            }
            else
            {
                $view->with('menus', Menu::with('subMenus')
                    ->where('status', true)
                    ->whereNull('parent_id')
                    ->where('level', 'client')
                    ->orderBy('display_order', 'asc')
                    ->get());
            }
        });
    }
}
