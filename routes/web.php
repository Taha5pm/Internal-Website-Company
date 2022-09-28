<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HomeController;
use App\Http\Controllers\EmployeeController as EmployeeController;
use App\Http\Controllers\NotificationController as NotificationController;
use App\Http\Controllers\RequestController;

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



Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'perfix' => '/superadmin',
        'middleware' => 'is_superadmin',
        'as'         => 'superadmin.',
    ], function () {

        Route::get('superadmin/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('superadmin/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('superadmin/employees/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('superadmin/employees/store', [EmployeeController::class, 'store'])->name('employee.store');

        Route::get('superadmin/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('superadmin/department/store', [DepartmentController::class, 'store'])->name('department.store');
    });

    Route::group([
        'perfix' => '/admin',
        'middleware' => 'is_admin',
        'as'         => 'admin.',
    ], function () {

        Route::get('admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('admin/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('admin/employees/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('admin/employees/store', [EmployeeController::class, 'store'])->name('employee.store');

        Route::get('admin/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('admin/department/store', [DepartmentController::class, 'store'])->name('department.store');

        Route::get('admin/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::put('admin/make_request/store', [NotificationController::class, 'store'])->name('notification.store');
    });

    Route::group([
        'perfix' => '/employee',
        'middleware' => 'is_employee',
        'as'         => 'employee.',
    ], function () {

        Route::get('employee/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('employee/Request/index', [RequestController::class, 'index'])->name('dashboard.index');
        Route::get('employee/Request/show_request', [RequestController::class, 'show'])->name('dashboard.show');

        Route::get('employee/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::put('employee/make_request/store', [NotificationController::class, 'store'])->name('notification.store');
    });

    Route::group([
        'perfix' => '/manager',
        'middleware' => 'is_manager',
        'as'         => 'manager.',
    ], function () {

        Route::get('manager/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('manager/Request/index', [RequestController::class, 'index'])->name('dashboard.index');
        Route::get('manager/Request/show_request', [RequestController::class, 'show'])->name('dashboard.show');

        Route::get('manager/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::put('manager/make_request/store', [NotificationController::class, 'store'])->name('notification.store');
    });
});



require __DIR__ . '/auth.php';
