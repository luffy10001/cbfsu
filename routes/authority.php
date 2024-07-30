<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorityController;

Route::group(['prefix'=>'line-of-authorities','groupName' => 'Line Of Authorities', 'access' => 'all'], function () {
    Route::get('/',[AuthorityController::class,'index'])->name('authority.index')->defaults('title','Listing');
    Route::get('create',[AuthorityController::class,'create'])->name('authority.create')->defaults('title','Create');
    Route::post('store',[AuthorityController::class,'store'])->name('authority.store')->defaults('title','Save');
    Route::get('{id}/edit', [AuthorityController::class, 'edit'])->name('authority.edit')->defaults('title','Edit');
    Route::post('update', [AuthorityController::class, 'update'])->name('authority.update')->defaults('title','Update');
    Route::get('{user}/view', [AuthorityController::class, 'show'])->name('authority.view')->defaults('title','Details');
    Route::post('delete/{id}',[AuthorityController::class,'delete'])->name('authority.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[AuthorityController::class,'status'])->name('authority.status')->defaults('title','Status');
});



