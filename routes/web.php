<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('landing-page.index'); });
Route::get('/sign-in', function () { return view('registration.sign-in'); })->name('registration.sign-in');
Route::get('/sign-up', function () { return view('registration.sign-up'); })->name('registration.sign-up');

Route::post('/sign-in/auth', [RegistrationController::class, 'sign_in'])->name('sign-in');
Route::post('/sign-up/auth', [RegistrationController::class, 'sign_up'])->name('sign-up');
Route::post('/sign-out/auth', [RegistrationController::class, 'sign_out'])->name('sign-out');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/student', function () {
        return view('dashboard');
    })->middleware('role:3');

});