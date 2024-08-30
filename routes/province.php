<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'state','groupName' => 'States', 'access' => 'all'], function () {
    Route::get('/', [ProvinceController::class, 'index'])->name('state.index')->defaults('title','Listing');
    Route::get('create', [ProvinceController::class, 'create'])->name('state.create')->defaults('title','Create');
    Route::post('store', [ProvinceController::class, 'store'])->name('state.store')->defaults('title','Save');
    Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('state.edit')->defaults('title','Edit');
    Route::post('update', [ProvinceController::class, 'update'])->name('state.update')->defaults('title','Update');
    Route::post('delete/{id}',[ProvinceController::class,'delete'])->name('state.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[ProvinceController::class,'status'])->name('state.status')->defaults('title','Status');


});

