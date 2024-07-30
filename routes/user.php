<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['prefix'=>'users','groupName' => 'Users', 'access' => 'all'], function () {
    Route::get('/',[UserController::class,'index'])->name('users.index')->defaults('title','Listing');
    Route::get('create',[UserController::class,'create'])->name('users.create')->defaults('title','Create');
    Route::post('store',[UserController::class,'store'])->name('users.store')->defaults('title','Save');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit')->defaults('title','Edit');
    Route::post('update', [UserController::class, 'update'])->name('users.update')->defaults('title','Update');
    Route::get('{user}/view', [UserController::class, 'view'])->name('users.view')->defaults('title','Details');
    Route::post('delete/{id}',[UserController::class,'delete'])->name('users.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[UserController::class,'status'])->name('users.status')->defaults('title','Status');
});

// Listing , Create, Save , Edit , Update, Details ,Delete , Status