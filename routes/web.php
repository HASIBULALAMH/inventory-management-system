<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Warehouse\WarehouseController;
use Illuminate\Support\Facades\Route;




//login 
Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //dashbo
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    //role
    Route::get('roles', [RoleController::class, 'list'])->name('roles.list');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');

    Route::get('roles/permissions/assign/{id}', [RoleController::class, 'permissionAssign'])->name('roles.permissions.assign');
    Route::post('roles/permissions/assign/store/{id}', [RoleController::class, 'permissionAssignStore'])->name('roles.permissions.assign.store');
    
    //permission
    Route::get('permissions', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
    
    //user 
    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function () {
    Route::get('users/list', [UserController::class, 'list'])->name('list');
    Route::get('users/create', [UserController::class, 'create'])->name('create');
    Route::post('users/store', [UserController::class, 'store'])->name('store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
 
    
    //department
    Route::get('departments', [DepartmentController::class, 'list'])->name('departments.list');
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('departments/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('departments/update/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
    
  // Designation Routes
Route::prefix('designations')->name('designations.')->group(function () {
    Route::get('designations/list', [DesignationController::class, 'list'])->name('list');
    Route::get('designations/create', [DesignationController::class, 'create'])->name('create');
    Route::post('designations/store', [DesignationController::class, 'store'])->name('store');
    Route::get('designations/edit/{id}', [DesignationController::class, 'edit'])->name('edit');
    Route::put('designations/update/{id}', [DesignationController::class, 'update'])->name('update');
    Route::delete('designations/delete/{id}', [DesignationController::class, 'delete'])->name('delete');
});
    // Location   
    Route::group([
        'prefix' => 'locations',
        'as' => 'locations.'
    ], function () { 
        Route::get('location/list', [LocationController::class, 'list'])->name('list');
        Route::get('location/create', [LocationController::class, 'create'])->name('create');
        Route::post('location/store', [LocationController::class, 'store'])->name('store');
        Route::post('location/change-status', [LocationController::class, 'changeStatus'])->name('changeStatus');
    });
   
    // Warehouse routes under admin
    Route::group([
        'prefix' => 'warehouse',
        'as' => 'warehouse.'
    ], function () {
        
        Route::get('warehouse/list', [WarehouseController::class, 'list'])->name('list');
        Route::get('warehouse/create', [WarehouseController::class, 'create'])->name('create');
        Route::post('warehouse/store', [WarehouseController::class, 'store'])->name('store');
        Route::get('warehouse/edit/{id}',[WarehouseController::class,'edit'])->name('edit');
        Route::put('warehouse/update/{id}', [WarehouseController::class, 'update'])->name('update');
        Route::delete('warehouse/delete/{id}', [WarehouseController::class, 'delete'])->name('delete');
        
        // AJAX routes for location
        Route::get('get-states/{countryId}', [WarehouseController::class, 'getStates']);
        Route::get('get-cities/{stateId}', [WarehouseController::class, 'getCities']);
        Route::get('get-thanas/{cityId}', [WarehouseController::class, 'getThanas']);
        Route::get('get-unions/{thanaId}', [WarehouseController::class, 'getUnions']);
        Route::get('get-zipcode/{unionId}', [WarehouseController::class, 'getZipcode']);
    });



    // Branch 
    Route::group([
        'prefix' => 'branch',
        'as' => 'branch.'
    ], function () {
        
        Route::get('branch/list', [BranchController::class, 'list'])->name('list');
        Route::get('branch/create', [BranchController::class, 'create'])->name('create');
        Route::post('branch/store', [BranchController::class, 'store'])->name('store');
        Route::get('branch/edit/{id}',[BranchController::class,'edit'])->name('edit');
        Route::put('branch/update/{id}', [BranchController::class, 'update'])->name('update');
        Route::delete('branch/delete/{id}', [BranchController::class, 'delete'])->name('delete');


        // AJAX 
        Route::get('get-states/{countryId}', [BranchController::class, 'getStates']);
        Route::get('get-cities/{stateId}', [BranchController::class, 'getCities']);
        Route::get('get-thanas/{cityId}', [BranchController::class, 'getThanas']);
        Route::get('get-unions/{thanaId}', [BranchController::class, 'getUnions']);
        Route::get('get-zipcode/{unionId}', [BranchController::class, 'getZipcode']);
        Route::get('get-managers/{userId}', [BranchController::class, 'getManagers']);
    });
});