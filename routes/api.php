<?php

use App\Http\Controllers\FactoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\HandlerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/section_handlers', [HandlerController::class, 'store']);
Route::get('/factories', [FactoryController::class, 'fetch']);
Route::get('/section_handlers/{section}', [SectionController::class, 'fetch'])->name('handler.fetch');
Route::get('/api/section_handlers/{id}', [HandlerController::class, 'getSectionHandlers']);
Route::post('/menus/update_order', [MenuController::class, 'updateOrder']);

Route::get('/roles/attach_menus/{role}', [RoleController::class, 'attachModalBody']);
Route::get('/roles/detach_menus/{role}', [RoleController::class, 'detachModalBody']);
