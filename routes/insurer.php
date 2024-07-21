<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsurerController;

Route::group(['prefix'=>'insurers','groupName' => 'Insurers', 'access' => 'all'], function () {
    Route::get('/',[InsurerController::class,'index'])->name('insurer.index');
    Route::get('create',[InsurerController::class,'create'])->name('insurer.create');
    Route::post('store',[InsurerController::class,'store'])->name('insurer.store');
    Route::get('{insurer}/edit', [InsurerController::class, 'edit'])->name('insurer.edit');
    Route::post('update', [InsurerController::class, 'update'])->name('insurer.update');
    Route::get('{insurer}/view', [InsurerController::class, 'view'])->name('insurer.view');
    Route::post('delete/{id}',[InsurerController::class,'delete'])->name('insurer.delete');
//    Route::post('status/{id}/{status}',[InsurerController::class,'status'])->name('insurer.status');
});