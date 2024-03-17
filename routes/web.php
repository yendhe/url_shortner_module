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

Route::get('/shorten', [App\Http\Controllers\UrlController::class, 'showShortenForm'])->name('shorten.form');
Route::post('/urls/shorten', [App\Http\Controllers\UrlController::class, 'shorten'])->name('urls.shorten');
Route::get('/upgrade', [App\Http\Controllers\UrlController::class, 'upgradeForm'])->name('upgrade.form');
Route::post('/upgrade', [App\Http\Controllers\UrlController::class, 'upgrade'])->name('upgrade');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::delete('/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('destroy');
Route::get('/{id}/edit', [App\Http\Controllers\HomeController::class, 'getByid'])->name('edit');
Route::put('/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::post('/{id}/deactivate',[App\Http\Controllers\HomeController::class, 'deactivate'])->name('deactivate');
