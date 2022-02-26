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
Route::get('dev', [App\Http\Controllers\HomeController::class, 'dev'])->name('dev_post');
Route::get('patient', [App\Http\Controllers\HomeController::class, 'patient_index'])->name('patient');
Route::get('patient/create', [App\Http\Controllers\HomeController::class, 'patient_create'])->name('patient.create');
Route::post('patient/add', [App\Http\Controllers\HomeController::class, 'patient_store'])->name('patient_store');
Route::get('patient/{id}/edit', [App\Http\Controllers\HomeController::class, 'patient_edit'])->name('patient.edit');
Route::put('patient/{id}/edit', [App\Http\Controllers\HomeController::class, 'patient_update'])->name('patient_update');
Route::get('appointment', [App\Http\Controllers\HomeController::class, 'appointment_index'])->name('appointment');
Route::get('appointment/create/{patient_id?}/', [App\Http\Controllers\HomeController::class, 'appoint_create'])->name('appoint.create');
Route::post('appointment/add', [App\Http\Controllers\HomeController::class, 'appoint_store'])->name('appoint_store');
Route::post('appointment/update', [App\Http\Controllers\HomeController::class, 'appoint_update'])->name('appoint_update');
Route::get('visit', [App\Http\Controllers\HomeController::class, 'visit_index'])->name('visit');
Route::get('visit/create', [App\Http\Controllers\HomeController::class, 'visit_create'])->name('visit.create');
Route::post('visit/add', [App\Http\Controllers\HomeController::class, 'visit_store'])->name('visit_store');
Route::get('get_visits/{patient_id}/', [App\Http\Controllers\HomeController::class, 'get_visits']);
// Route::get('donor', [App\Http\Controllers\HomeController::class, 'donor_index'])->name('donor');
Route::get('donor/create', [App\Http\Controllers\HomeController::class, 'donor_create'])->name('donor.create');
Route::post('donor/add', [App\Http\Controllers\HomeController::class, 'donor_store'])->name('donor_store');