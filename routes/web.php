<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [BaseController::class, 'index']);

Route::get('/show', [VehicleController::class, 'show'])->name('show');

Route::get('/details/{id}', [VehicleController::class, 'details'])->middleware('auth');

Route::get('/fetch_image/{id}', [VehicleController::class, 'fetchImage'])->name('fetch');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', [VehicleController::class, 'index'])->name('create')->middleware('auth');

Route::post('/create', [VehicleController::class, 'create'])->middleware('auth');

Route::get('/edit/{id}', [VehicleController::class, 'edit'])->middleware('auth');

Route::post('/edit/{id}', [VehicleController::class, 'update'])->middleware('auth');

Route::get('/delete/{id}', [VehicleController::class, 'delete'])->middleware('auth');

Route::get('/purchase/{id}', [VehicleController::class, 'purchase'])->middleware('auth');

Route::get('/markRead/{id}', [HomeController::class, 'markRead'])->middleware('auth');

Route::get('/search', [VehicleController::class, 'search']);