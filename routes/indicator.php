<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndicatorController;

Route::group(['prefix'=>'indicators','groupName' => 'Indicators', 'access' => 'all'], function () {
    Route::get('/', [IndicatorController::class, 'index'])->name('indicator.index');
    Route::get('create', [IndicatorController::class, 'create'])->name('indicator.create');
    Route::post('store', [IndicatorController::class, 'store'])->name('indicator.store');
    Route::get('{indicator}/edit', [IndicatorController::class, 'edit'])->name('indicator.edit');
    Route::post('update', [IndicatorController::class, 'update'])->name('indicator.update');
    Route::post('delete/{id}',[IndicatorController::class,'delete'])->name('indicator.delete');
    Route::post('status/{id}/{status}',[IndicatorController::class,'status'])->name('indicator.status');


});