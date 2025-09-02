<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('admin.master');
});


//login
Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    //dashboard
    Route::get('dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');

    //role
    Route::get('roles', [RoleController::class, 'list'])->name('roles.list');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store'); 
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');


    //permission 
    Route::get('permissions', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

    //permission assign
    Route::get('roles/permissions/assign/{id}', [RoleController::class, 'permissionAssign'])->name('roles.permissions.assign');
    Route::post('roles/permissions/assign/{id}', [RoleController::class, 'permissionAssignStore'])->name('roles.permissions.assign.store');


    //user
    Route::get('users', [UserController::class, 'list'])->name('users.list');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');







    //department
    Route::get('departments', [DepartmentController::class, 'list'])->name('departments.list');
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('departments/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('departments/update/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');



    //designation
    Route::get('designations', [DesignationController::class, 'list'])->name('designations.list');
    Route::get('designations/create', [DesignationController::class, 'create'])->name('designations.create');
    Route::post('designations/store', [DesignationController::class, 'store'])->name('designations.store');

});
