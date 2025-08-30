<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.master');
});


//login
Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');


Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {
        //dashboard
        Route::get('dashboard',[DashboardController::class,'Dashboard'])->name('admin.dashboard');

        //role
        Route::get('roles', [RoleController::class, 'list'])->name('roles.list');
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store'); 
        Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::delete('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    });

});
