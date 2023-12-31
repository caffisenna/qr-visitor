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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('visitors', App\Http\Controllers\visitorsController::class);
Route::get('/visitors_sum/', [App\Http\Controllers\visitorsController::class, 'sum'])->name('sum');
Route::get('/export', [App\Http\Controllers\visitorsController::class, 'export_to_excel'])->name('export_to_excel');
