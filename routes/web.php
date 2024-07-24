<?php

use App\Http\Controllers\FactoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\HandlerController;;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');
    Route::put('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

    Route::resource('/roles', RoleController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/factories', FactoryController::class);
    Route::resource('/sections', SectionController::class);
    Route::resource('/handlers', HandlerController::class);

    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');
});
