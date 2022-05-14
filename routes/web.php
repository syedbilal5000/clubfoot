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
Route::get('/pdf/{patient_id}/', [App\Http\Controllers\PDFController::class, 'index']);
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
Route::get('donor', [App\Http\Controllers\HomeController::class, 'donor_index'])->name('donor');
Route::get('donor/create', [App\Http\Controllers\HomeController::class, 'donor_create'])->name('donor.create');
Route::post('donor/add', [App\Http\Controllers\HomeController::class, 'donor_store'])->name('donor_store');
Route::get('donor/{id}/edit', [App\Http\Controllers\HomeController::class, 'donor_edit'])->name('donor.edit');
Route::put('donor/{id}/edit', [App\Http\Controllers\HomeController::class, 'donor_update'])->name('donor_update');
Route::get('followup', [App\Http\Controllers\HomeController::class, 'followup_index'])->name('followup');
Route::get('followup/create', [App\Http\Controllers\HomeController::class, 'followup_create'])->name('followup.create');
Route::post('followup/add', [App\Http\Controllers\HomeController::class, 'followup_store'])->name('followup_store');
// Route::get('followup/{id}/edit', [App\Http\Controllers\HomeController::class, 'followup_edit'])->name('followup.edit');
Route::get('analytic', [App\Http\Controllers\HomeController::class, 'analytic_index'])->name('analytic');
Route::get('home/dashboard/{st_dt}/{ed_dt}/', [App\Http\Controllers\HomeController::class, 'dashboard_report']);
Route::get('analytic/casted_more', [App\Http\Controllers\HomeController::class, 'casted_more_view'])->name('analytic.casted_more_view');
Route::get('analytic/casted_more_report/{st_dt}/{ed_dt}/', [App\Http\Controllers\HomeController::class, 'casted_more_report']);
Route::get('analytic/casted_same', [App\Http\Controllers\HomeController::class, 'casted_same_view'])->name('analytic.casted_same_view');
Route::get('analytic/casted_same_report/{st_dt}/{ed_dt}/', [App\Http\Controllers\HomeController::class, 'casted_same_report']);
Route::get('analytic/visits/{type}/', [App\Http\Controllers\HomeController::class, 'visits_view'])->name('analytic.visits_view');
Route::get('analytic/appoint_delayed', [App\Http\Controllers\HomeController::class, 'appoint_delayed_view'])->name('analytic.appoint_delayed_view');
Route::get('analytic/appoint_delayed_report/{st_dt}/{ed_dt}/', [App\Http\Controllers\HomeController::class, 'appoint_delayed_report']);
Route::post('analytic/appoint_delayed/add', [App\Http\Controllers\HomeController::class, 'appoint_delayed_store'])->name('appoint_delayed_store');

Route::get('category', [App\Http\Controllers\HomeController::class, 'category_index'])->name('category');
Route::get('category/create', [App\Http\Controllers\HomeController::class, 'category_create'])->name('category.create');
Route::post('category/add', [App\Http\Controllers\HomeController::class, 'category_store'])->name('category_store');
// Route::get('donor/{id}/edit', [App\Http\Controllers\HomeController::class, 'donor_edit'])->name('donor.edit');
// Route::put('donor/{id}/edit', [App\Http\Controllers\HomeController::class, 'donor_update'])->name('donor_update');
Route::get('expense', [App\Http\Controllers\HomeController::class, 'expense_index'])->name('expense');
Route::get('expense/create', [App\Http\Controllers\HomeController::class, 'expense_create'])->name('expense.create');
Route::post('expense/add', [App\Http\Controllers\HomeController::class, 'expense_store'])->name('expense_store');
Route::get('item', [App\Http\Controllers\HomeController::class, 'item_index'])->name('item');
Route::get('item/create', [App\Http\Controllers\HomeController::class, 'item_create'])->name('item.create');
Route::post('item/add', [App\Http\Controllers\HomeController::class, 'item_store'])->name('item_store');
Route::get('inventory', [App\Http\Controllers\HomeController::class, 'inventory_index'])->name('inventory');
Route::get('inventory/create', [App\Http\Controllers\HomeController::class, 'inventory_create'])->name('inventory.create');
Route::post('inventory/add', [App\Http\Controllers\HomeController::class, 'inventory_store'])->name('inventory_store');
