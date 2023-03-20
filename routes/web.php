<?php

use App\Http\Controllers\LoginController;
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
    return view('index');
});

Route::controller(LoginController::class)->group(function(){

    Route::get('login', 'index')->name('login');

    Route::get('registration', 'registration')->name('registration');

    Route::get('logout', 'logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');

    Route::post('validate_login', 'validate_login')->name('sample.validate_login');

    Route::get('dashboard', 'dashboard')->name('dashboard');

});

Route::post('/users/{id}/access-email', [LoginController::class, 'accessEmail']);
Route::get('/credits', [LoginController::class, 'getCredits'])->name('get.credits');
Route::post('/download-data', [LoginController::class, 'downloadData'])->name('download-data');
Route::post('/apply-filter', [LoginController::class, 'applyFilter'])->name('apply-filter');







