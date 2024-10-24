<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignatureController;

Route::group(['prefix'=>'signature','groupName' => 'Signature', 'access' => 'all'], function () {
    Route::get('/',[SignatureController::class,'index'])->name('signature.index')->defaults('title','Listing');
    Route::get('create',[SignatureController::class,'create'])->name('signature.create')->defaults('title','Create');
    Route::post('store',[SignatureController::class,'store'])->name('signature.store')->defaults('title','Save');
    Route::get('{id}/edit', [SignatureController::class, 'edit'])->name('signature.edit')->defaults('title','Edit');
    Route::post('update', [SignatureController::class, 'update'])->name('signature.update')->defaults('title','Update');
    Route::get('{id}/view', [SignatureController::class, 'detail'])->name('signature.view')->defaults('title','Details');
    Route::post('delete/{id}',[SignatureController::class,'destroy'])->name('signature.delete')->defaults('title','Delete');
});
