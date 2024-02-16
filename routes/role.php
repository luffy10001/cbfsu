<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'roles','groupName' => 'Roles', 'access' => 'all'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles.index');
    Route::post('store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('update', [RoleController::class, 'update'])->name('roles.update');
    Route::get('get-permissions/{roleId}/role', [PermissionController::class, 'getPermissions'])->name('roles.getPermissions');
    Route::post('/permissions/store',[PermissionController::class,'store'])->name('roles.permission.store');


});