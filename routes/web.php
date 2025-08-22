<?php

use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('admin.master');
});

Route::get('dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');