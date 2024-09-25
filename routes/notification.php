<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'notifications','groupName' => 'Notification', 'access' => 'all'], function () {

    Route::get('/',[NotificationController::class,'index'])->name('notifications.index')->defaults('title','Listing');
    Route::get('show/{$id}',[NotificationController::class,'show'])->name('notifications.show')->defaults('title','View');
    Route::get('create',[NotificationController::class,'create'])->name('notifications.create')->defaults('title','Create');

});