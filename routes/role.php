<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'roles','groupName' => 'Roles', 'access' => 'all'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles.index')->defaults('title','Listing');
    Route::get('create', [RoleController::class, 'create'])->name('roles.create')->defaults('title','Create');
    Route::post('store', [RoleController::class, 'store'])->name('roles.store')->defaults('title','Save');
    Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->defaults('title','Edit');
    Route::post('update', [RoleController::class, 'update'])->name('roles.update')->defaults('title','Update');
    Route::get('get-permissions/{roleId}/role', [PermissionController::class, 'getPermissions'])->name('roles.getPermissions')->defaults('title','Assign Role Permissions');
    Route::post('/permissions/store',[PermissionController::class,'store'])->name('roles.permission.store')->defaults('title','Save Permissions');
});

