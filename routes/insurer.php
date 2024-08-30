<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsurerController;

Route::group(['prefix'=>'insurers','groupName' => 'Insurers', 'access' => 'all'], function () {
    Route::get('/',[InsurerController::class,'index'])->name('insurer.index')->defaults('title','Listing');
    Route::get('create',[InsurerController::class,'create'])->name('insurer.create')->defaults('title','Create');
    Route::post('store',[InsurerController::class,'store'])->name('insurer.store')->defaults('title','Save');
    Route::get('{insurer}/edit', [InsurerController::class, 'edit'])->name('insurer.edit')->defaults('title','Edit');
    Route::post('update', [InsurerController::class, 'update'])->name('insurer.update')->defaults('title','Update');
    Route::get('{insurer}/view', [InsurerController::class, 'view'])->name('insurer.view')->defaults('title','Details');
    Route::post('delete/{id}',[InsurerController::class,'delete'])->name('insurer.delete')->defaults('title','Delete');
//    Route::post('status/{id}/{status}',[InsurerController::class,'status'])->name('insurer.status');
});


//->defaults('title','');

// Listing , Create, Save , Edit , Update, Details ,Delete , Status