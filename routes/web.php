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
    // return view('index');
    return redirect('login');
});

Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home/registration', function () {
//     return view('registration.index');
// });
Route::post('dev', [App\Http\Controllers\HomeController::class, 'dev'])->name('dev_post');
Route::get('patients', [App\Http\Controllers\HomeController::class, 'patients_index'])->name('patients');
Route::get('patients/create', [App\Http\Controllers\HomeController::class, 'patients_create'])->name('patients.create');
Route::post('patients/add', [App\Http\Controllers\HomeController::class, 'patient_store'])->name('patient_store');
Route::get('patients/{id}/edit', [App\Http\Controllers\HomeController::class, 'patients_edit'])->name('patients.edit');
Route::put('patients/{id}/edit', [App\Http\Controllers\HomeController::class, 'patient_update'])->name('patients_update');
Route::get('appointment', [App\Http\Controllers\HomeController::class, 'appointment_index'])->name('appointment');
Route::get('appointment/create', [App\Http\Controllers\HomeController::class, 'appoint_create'])->name('appoint.create');
Route::post('appointment/add', [App\Http\Controllers\HomeController::class, 'appoint_store'])->name('appoint_store');
Route::post('appointment/update', [App\Http\Controllers\HomeController::class, 'appoint_update'])->name('appoint_update');
Route::get('visit', [App\Http\Controllers\HomeController::class, 'visit_index'])->name('visit_index');
