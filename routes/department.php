<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'departments','groupName' => 'Departments', 'access' => 'all'], function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('update', [DepartmentController::class, 'update'])->name('departments.update');

});