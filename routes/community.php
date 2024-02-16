<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'communities','groupName' => 'Communities', 'access' => 'all'], function () {
    Route::get('/', [CommunityController::class, 'index'])->name('community.index');
    Route::get('create', [CommunityController::class, 'create'])->name('community.create');
    Route::post('store', [CommunityController::class, 'store'])->name('community.store');
    Route::get('{community}/edit', [CommunityController::class, 'edit'])->name('community.edit');
    Route::post('update', [CommunityController::class, 'update'])->name('community.update');
    Route::post('delete/{id}',[CommunityController::class,'delete'])->name('community.delete');
    Route::post('status/{id}/{status}',[CommunityController::class,'status'])->name('community.status');


});