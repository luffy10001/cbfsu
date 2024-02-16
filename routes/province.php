<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'province','groupName' => 'Province', 'access' => 'all'], function () {
    Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
    Route::get('create', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
    Route::post('update', [ProvinceController::class, 'update'])->name('province.update');
    Route::post('delete/{id}',[ProvinceController::class,'delete'])->name('province.delete');
    Route::post('status/{id}/{status}',[ProvinceController::class,'status'])->name('province.status');


});