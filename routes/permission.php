<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::group(['prefix'=>'permissions','groupName' => 'Permissions', 'access' => 'all'], function () {
    Route::get('/',[PermissionController::class,'index'])->name('permissions.index');
    Route::get('create',[PermissionController::class,'create'])->name('permissions.create');
    Route::post('store',[PermissionController::class,'store'])->name('permissions.store');
    Route::get('{permission}/edit',[PermissionController::class,'edit'])->name('permissions.edit');
    Route::post('update',[PermissionController::class,'update'])->name('permissions.update');
});