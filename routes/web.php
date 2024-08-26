<?php

use App\Http\Controllers\FactoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\HandlerController;;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AddController;
use App\Http\Controllers\TimeLineController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EmployeeComplaintController;
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
    Route::get('/user/activities', [UserController::class, 'activities'])->name('user.user-activities');

    Route::resource('/roles', RoleController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/factories', FactoryController::class);
    Route::resource('/sections', SectionController::class);
    Route::get('/sections/{section}/handlers', [HandlerController::class, 'showHandlers'])->name('section-handlers.show');
    Route::resource('/handlers', HandlerController::class);
    // routes/web.php
Route::resource('section-handlers', SectionHandlerController::class);

    // routes/web.php
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::resource('employees', EmployeeController::class);
    Route::resource('complaints', ComplaintController::class);
    Route::get('complaints/{complaint}/timeline', [ComplaintController::class, 'show'])->name('complaints.timeline.show');
    Route::get('complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');

    Route::put('complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
Route::get('/employee/complaints', [EmployeeComplaintController::class, 'index'])->name('employee.complaints.index');
Route::prefix('client')->group(function () {
    Route::get('complaints', [ComplaintController::class, 'indexClient'])->name('client.complaints.index');
    Route::get('complaints/create', [ComplaintController::class, 'createClient'])->name('client.complaints.create');
    Route::post('complaints', [ComplaintController::class, 'storeClient'])->name('client.complaints.store');
    Route::get('complaints/{complaint}', [ComplaintController::class, 'showClient'])->name('client.complaints.show');
    Route::get('complaints/{complaint}/edit', [ComplaintController::class, 'editClient'])->name('client.complaints.edit');
    Route::put('complaints/{complaint}', [ComplaintController::class, 'updateClient'])->name('client.complaints.update');
    Route::delete('complaints/{complaint}', [ComplaintController::class, 'destroyClient'])->name('client.complaints.destroy');
    Route::get('/complaints/{id}/timeline', [TimeLineController::class, 'show'])->name('timeline.show');

});
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');
});
