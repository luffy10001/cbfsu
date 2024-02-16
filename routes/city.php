<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;

Route::group(['prefix'=>'cities','groupName' => 'Cities', 'access' => 'all'], function () {
    Route::get('/', [CityController::class, 'index'])->name('city.index');
    Route::get('create', [CityController::class, 'create'])->name('city.create');
    Route::post('store', [CityController::class, 'store'])->name('city.store');
    Route::get('{city}/edit', [CityController::class, 'edit'])->name('city.edit');
    Route::post('update', [CityController::class, 'update'])->name('city.update');
    Route::post('delete/{id}',[CityController::class,'delete'])->name('city.delete');
    Route::post('status/{id}/{status}',[CityController::class,'status'])->name('city.status');


});