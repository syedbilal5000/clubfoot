<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home/registration', function () {
//     return view('registration.index');
// });
Route::get('registration', [App\Http\Controllers\HomeController::class, 'register_index'])->name('register_index');
Route::post('registration/add', [App\Http\Controllers\HomeController::class, 'register_store'])->name('register_store');
Route::get('appointment', [App\Http\Controllers\HomeController::class, 'appointment_index'])->name('appointment_index');
Route::get('visit', [App\Http\Controllers\HomeController::class, 'visit_index'])->name('visit_index');