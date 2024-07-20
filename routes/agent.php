<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::group(['prefix'=>'agents','groupName' => 'Agents', 'access' => 'all'], function () {
    Route::get('/', [AgentController::class, 'index'])->name('agent.index');
    Route::get('create', [AgentController::class, 'create'])->name('agent.create');
    Route::post('store', [AgentController::class, 'store'])->name('agent.store');
    Route::get('{agent}/edit', [AgentController::class, 'edit'])->name('agent.edit');
    Route::post('update', [AgentController::class, 'update'])->name('agent.update');
    Route::get('{agent}/view', [AgentController::class, 'view'])->name('agent.view');
    Route::post('delete/{id}',[AgentController::class,'delete'])->name('agent.delete');
    Route::post('status/{id}/{status}',[AgentController::class,'status'])->name('agent.status');


});