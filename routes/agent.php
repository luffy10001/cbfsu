<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::group(['prefix'=>'agents','groupName' => 'Agents', 'access' => 'all'], function () {
    Route::get('/', [AgentController::class, 'index'])->name('agent.index')->defaults('title','Listing');
    Route::get('create', [AgentController::class, 'create'])->name('agent.create')->defaults('title','Create');
    Route::post('store', [AgentController::class, 'store'])->name('agent.store')->defaults('title','Save');
    Route::get('{agent}/edit', [AgentController::class, 'edit'])->name('agent.edit')->defaults('title','Edit');
    Route::post('update', [AgentController::class, 'update'])->name('agent.update')->defaults('title','Update');
    Route::get('{agent}/view', [AgentController::class, 'view'])->name('agent.view')->defaults('title','Details');
    Route::post('delete/{id}',[AgentController::class,'delete'])->name('agent.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[AgentController::class,'status'])->name('agent.status')->defaults('title','Status');
});