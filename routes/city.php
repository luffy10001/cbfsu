<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;

Route::group(['prefix'=>'cities','groupName' => 'Cities', 'access' => 'all'], function () {
    Route::get('/', [CityController::class, 'index'])->name('city.index')->defaults('title','Listing');
    Route::get('create', [CityController::class, 'create'])->name('city.create')->defaults('title','Create');
    Route::post('store', [CityController::class, 'store'])->name('city.store')->defaults('title','Save');
    Route::get('{city}/edit', [CityController::class, 'edit'])->name('city.edit')->defaults('title','Edit');
    Route::post('update', [CityController::class, 'update'])->name('city.update')->defaults('title','Update');
    Route::post('delete/{id}',[CityController::class,'delete'])->name('city.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[CityController::class,'status'])->name('city.status')->defaults('title','Status');
});