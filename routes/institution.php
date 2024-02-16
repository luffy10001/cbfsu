<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\UserPermissions\PermissionController;

Route::group(['prefix'=>'institutions','groupName' => 'Institutions', 'access' => 'all'], function () {
    Route::get('/', [InstitutionController::class, 'index'])->name('institution.index');

});