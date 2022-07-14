<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlChecksController;

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


Route::get('/', [UrlController::class, 'create'])->name('create');
Route::post('/urls', [UrlController::class, 'store'])->name('urls_store');
Route::get('urls/{id}', [UrlController::class, 'show'])->name('urls_show');
Route::get('/urls', [UrlController::class, 'index'])->name('urls');
Route::post('/urls/{id}/checks', [UrlChecksController::class, 'store'])->name('urls_checks');
