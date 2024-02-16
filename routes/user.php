<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['prefix'=>'users','groupName' => 'Users', 'access' => 'all'], function () {
    Route::get('/',[UserController::class,'index'])->name('users.index');
    Route::get('create',[UserController::class,'create'])->name('users.create');
    Route::post('store',[UserController::class,'store'])->name('users.store');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('update', [UserController::class, 'update'])->name('users.update');

    Route::get('department/get-roles',[UserController::class,'getDepartmentRoles'])->name('department.get-roles');
});