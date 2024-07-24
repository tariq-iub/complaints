<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\FactoryUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionHandlerController;;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');
    Route::put('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');
    Route::resource('/roles', RoleController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/factories', FactoryController::class);
    Route::resource('/sites', SiteController::class);
    Route::resource('/sections', SectionController::class);
    // routes/web.php
    Route::get('/sections/{section}/handlers', [SectionHandlerController::class, 'showHandlers'])->name('section-handlers.show');
    Route::get('/sections/{section}/handlers/create', [SectionHandlerController::class, 'create'])->name('section-handlers.create');
    Route::resource('/devices', DeviceController::class);
    Route::controller(DataFileController::class)
        ->as('files.')
        ->group(function () {
            Route::get('/files', 'index')->name('index');
            Route::get('/files/{data_file}/edit', 'edit')->name('edit');
            Route::put('/files/{data_file}', 'update')->name('update');
            Route::delete('/files/{data_file}', 'destroy')->name('delete');
            Route::get('/files/download/{data_file}', 'download')->name('download');
            Route::get('/files/data', 'getData')->name('data');
        });
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');
});
