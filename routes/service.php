<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::group(['prefix'=>'services','groupName' => 'Services', 'access' => 'all'], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('service.index');
    Route::get('create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('update', [ServiceController::class, 'update'])->name('service.update');
    Route::post('delete/{id}',[ServiceController::class,'delete'])->name('service.delete');
    Route::post('status/{id}/{status}',[ServiceController::class,'status'])->name('service.status');


});