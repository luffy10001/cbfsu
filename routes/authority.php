<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorityController;

Route::group(['prefix'=>'line-of-authorities','groupName' => 'Line Of Authorities', 'access' => 'all'], function () {
    Route::get('/',[AuthorityController::class,'index'])->name('authority.index');
    Route::get('create',[AuthorityController::class,'create'])->name('authority.create');
    Route::post('store',[AuthorityController::class,'store'])->name('authority.store');
    Route::get('{id}/edit', [AuthorityController::class, 'edit'])->name('authority.edit');
    Route::post('update', [AuthorityController::class, 'update'])->name('authority.update');
    Route::get('{user}/view', [AuthorityController::class, 'show'])->name('authority.view');
    Route::post('delete/{id}',[AuthorityController::class,'delete'])->name('authority.delete');
    Route::post('status/{id}/{status}',[AuthorityController::class,'status'])->name('authority.status');
});
