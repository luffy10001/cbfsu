<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('state/get-cities',[ProvinceController::class,'getStateCities'])->name('state.get-cities');
    Route::post('append/surety_details', [CustomerController::class, 'surety_details'])->name('surety_details.append');
    Route::get('get-insurer/{id}',[\App\Http\Controllers\ProjectController::class,'insurers'])->name('project_management.getInsurers');
});

Route::group(['middleware' => ['auth', 'user_permission']], function () {
    include __DIR__ . '/user.php';
    include __DIR__ . '/role.php';
    include __DIR__ . '/permission.php';
    include __DIR__ . '/dashboard.php';
    include __DIR__ . '/province.php';
    include __DIR__ . '/city.php';
    include __DIR__ . '/agent.php';
    include __DIR__ . '/customer.php';
    include __DIR__ . '/insurer.php';
    include __DIR__ . '/authority.php';
    include __DIR__ . '/project.php';

});



require __DIR__.'/auth.php';

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
