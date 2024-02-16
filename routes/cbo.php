<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CboController;

Route::group(['prefix'=>'cbos','groupName' => 'CBOs', 'access' => 'all'], function () {
    Route::get('/', [CboController::class, 'index'])->name('cbo.index');
    Route::get('create', [CboController::class, 'create'])->name('cbo.create');
//    Route::post('store', [CboController::class, 'store'])->name('cbo.store');
//    Route::get('{cbo}/edit', [CboController::class, 'edit'])->name('cbo.edit');
//    Route::post('update', [CboController::class, 'update'])->name('cbo.update');
//    Route::post('delete/{id}',[CboController::class,'delete'])->name('cbo.delete');
//    Route::post('status/{id}/{status}',[CboController::class,'status'])->name('cbo.status');


});