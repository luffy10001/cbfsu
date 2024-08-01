<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectManagementController;

Route::group(['prefix'=>'project-management','groupName' => 'Project Management', 'access' => 'all'], function () {
    Route::get('/',[ProjectManagementController::class,'index'])->name('project-management.index')->defaults('title','Listing');
    Route::get('create',[ProjectManagementController::class,'create'])->name('project-management.create')->defaults('title','Create');
    Route::post('store',[ProjectManagementController::class,'store'])->name('project-management.store')->defaults('title','Save');
    Route::get('{id}/edit', [ProjectManagementController::class, 'edit'])->name('project-management.edit')->defaults('title','Edit');
    Route::post('update', [ProjectManagementController::class, 'update'])->name('project-management.update')->defaults('title','Update');
    Route::get('{id}/view', [ProjectManagementController::class, 'show'])->name('project-management.view')->defaults('title','Details');
    Route::post('delete/{id}',[ProjectManagementController::class,'destroy'])->name('project-management.delete')->defaults('title','Delete');
});



