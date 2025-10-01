<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Warehouse\WarehouseController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.master');
});

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
    Route::get('users', [UserController::class, 'list'])->name('users.list');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');


    //ajex user 
    Route::get('/user/get-states/{country}',[UserController::class,'getStates']);
    Route::get('/user/get-cities/{state}', [UserController::class,'getCities']);
    Route::get('/user/get-zipcode/{city}', [UserController::class,'getZipcode']);
    
    
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
    Route::get('designations/edit/{id}', [DesignationController::class, 'edit'])->name('designations.edit');
    Route::put('designations/update/{id}', [DesignationController::class, 'update'])->name('designations.update');
    Route::delete('designations/delete/{id}', [DesignationController::class, 'delete'])->name('designations.delete');
    
    // Location routes under admin
    Route::group([
        'prefix' => 'locations',
        'as' => 'locations.'
    ], function () {   
        //country
        Route::get('countries', [CountryController::class, 'list'])->name('countries.list');
        Route::get('countries/create', [CountryController::class, 'create'])->name('countries.create');
        Route::post('countries/store', [CountryController::class, 'store'])->name('countries.store');
        Route::get('countries/edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
        Route::put('countries/update/{id}', [CountryController::class, 'update'])->name('countries.update');
        Route::delete('countries/delete/{id}', [CountryController::class, 'delete'])->name('countries.delete');
        
        //state
        Route::get('states', [StateController::class, 'list'])->name('states.list');
        Route::get('states/create', [StateController::class, 'create'])->name('states.create');
        Route::post('states/store', [StateController::class, 'store'])->name('states.store');
        Route::get('states/edit/{id}', [StateController::class, 'edit'])->name('states.edit');
        Route::put('states/update/{id}', [StateController::class, 'update'])->name('states.update');
        Route::delete('states/delete/{id}', [StateController::class, 'delete'])->name('states.delete');
        
        //city
        Route::get('cities', [CityController::class, 'list'])->name('cities.list');
        Route::get('cities/create', [CityController::class, 'create'])->name('cities.create');
        Route::post('cities/store', [CityController::class, 'store'])->name('cities.store');
        Route::get('cities/edit/{id}', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('cities/update/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('cities/delete/{id}', [CityController::class, 'delete'])->name('cities.delete');
    });
   
    // Warehouse routes under admin
    Route::group([
        'prefix' => 'warehouse',
        'as' => 'warehouse.'
    ], function () {
        Route::get('warehouses', [WarehouseController::class, 'list'])->name('list');
        Route::get('warehouses/create', [WarehouseController::class, 'create'])->name('create');
        Route::post('warehouses/store', [WarehouseController::class, 'store'])->name('store');
        Route::get('warehouses/edit/{id}', [WarehouseController::class, 'edit'])->name('edit');
        Route::put('warehouses/update/{id}', [WarehouseController::class, 'update'])->name('update');
        Route::delete('warehouses/delete/{id}', [WarehouseController::class, 'delete'])->name('delete');
            //ajex
            Route::get('get-states/{country}', [WarehouseController::class, 'getStates'])->name('get-states');
            Route::get('get-cities/{state}', [WarehouseController::class, 'getCities'])->name('get-cities');
            Route::get('get-zipcode/{city}', [WarehouseController::class, 'getZipcode'])->name('get-zipcode');
            Route::get('get-manager/{user}', [WarehouseController::class, 'getManager'])->name('get-manager');
          });
    });