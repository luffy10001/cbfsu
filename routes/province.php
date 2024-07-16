<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'state','groupName' => 'States', 'access' => 'all'], function () {
    Route::get('/', [ProvinceController::class, 'index'])->name('state.index');
    Route::get('create', [ProvinceController::class, 'create'])->name('state.create');
    Route::post('store', [ProvinceController::class, 'store'])->name('state.store');
    Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('state.edit');
    Route::post('update', [ProvinceController::class, 'update'])->name('state.update');
    Route::post('delete/{id}',[ProvinceController::class,'delete'])->name('state.delete');
    Route::post('status/{id}/{status}',[ProvinceController::class,'status'])->name('state.status');


});