<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'dashboard','groupName' => 'Dashboards', 'access' => 'all'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});