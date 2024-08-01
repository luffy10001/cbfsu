<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::group(['prefix'=>'projects','groupName' => 'Projects', 'access' => 'all'], function () {
    Route::get('/',[ProjectController::class,'index'])->name('project.index')->defaults('title','Listing');
    Route::get('create',[ProjectController::class,'create'])->name('project.create')->defaults('title','Create');
    Route::post('store',[ProjectController::class,'store'])->name('project.store')->defaults('title','Save');
    Route::get('{id}/edit', [ProjectController::class, 'edit'])->name('project.edit')->defaults('title','Edit');
    Route::post('update', [ProjectController::class, 'update'])->name('project.update')->defaults('title','Update');
    Route::get('{id}/view', [ProjectController::class, 'show'])->name('project.view')->defaults('title','Details');
    Route::post('delete/{id}',[ProjectController::class,'destroy'])->name('project.delete')->defaults('title','Delete');
});



