<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::group(['prefix'=>'customers','groupName' => 'Customers', 'access' => 'all'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('{customer}/view', [CustomerController::class, 'view'])->name('customer.view');
    Route::post('delete/{id}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::post('status/{id}/{status}',[CustomerController::class,'status'])->name('customer.status');


});