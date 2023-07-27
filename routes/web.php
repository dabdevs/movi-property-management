<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckPermission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Routes accessible only by admins
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/properties', [AdminController::class, 'properties'])->name('admin.properties');
        Route::get('/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
        // Add more admin routes here
    });
});

Route::group(['middleware' => ['auth', 'role:property_manager']], function () {
    // Routes accessible only by property managers
});

Route::group(['middleware' => ['auth', 'role:property_owner']], function () {
    // Routes accessible only by property owners
});

Route::group(['middleware' => ['auth', 'permission:view_properties']], function () {
    // Routes accessible only by users with "view_properties" permission
});

Route::middleware(['auth', 'permission:edit_property'])->group(function () {
    // Routes accessible only by users with "edit_property" permission
});


require __DIR__.'/auth.php';
