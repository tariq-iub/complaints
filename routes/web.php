<?php

use App\Http\Controllers\FactoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\TimeLineController;
use App\Http\Controllers\EmployeeComplaintController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqCategoryController;
=======
>>>>>>> d55b93413d7bb851e2a5d91d836889dc867164a3
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function ()
{
    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');
    Route::get('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

    Route::resource('/roles', RoleController::class);
    Route::post('/roles/role_menu_attachment', [RoleController::class, 'roleMenuAttachment'])->name('roles.role_menu_attachment');
    Route::post('/roles/role_menu_detachment', [RoleController::class, 'roleMenuDetachment'])->name('roles.role_menu_detachment');
    Route::resource('/menus', MenuController::class);
    Route::put('/menus/{menu}', [MenuController::class, 'statusToggle'])->name('menus.toggle');
    Route::resource('/factories', FactoryController::class);
    Route::resource('/sections', SectionController::class);
    Route::get('/sections/{section}/handlers', [HandlerController::class, 'showHandlers'])->name('section-handlers.show');
    Route::resource('/handlers', HandlerController::class);

    Route::resource('/employees', EmployeeController::class);
    Route::resource('/complaints', ComplaintController::class);
    Route::get('/complaints/{complaint}/timeline', [ComplaintController::class, 'show'])->name('complaints.timeline.show');
    Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');

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
Route::get('/faq', [FaqCategoryController::class, 'index'])->name('client.faq.index');

Route::get('/reports', function () {
    return view('reports.index');
})->name('reports');

});
