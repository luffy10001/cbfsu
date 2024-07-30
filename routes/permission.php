<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::group(['prefix'=>'permissions','groupName' => 'Permissions', 'access' => 'all'], function () {
    Route::get('/',[PermissionController::class,'index'])->name('permissions.index')->defaults('title','Listing');
    Route::get('create',[PermissionController::class,'create'])->name('permissions.create')->defaults('title','Create');
    Route::post('store',[PermissionController::class,'store'])->name('permissions.store')->defaults('title','Save');
    Route::get('{permission}/edit',[PermissionController::class,'edit'])->name('permissions.edit')->defaults('title','Edit');
    Route::post('update',[PermissionController::class,'update'])->name('permissions.update')->defaults('title','Update');
});


