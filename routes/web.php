<?php

use App\Http\Controllers\CodeIgniterCGController;
use App\Http\Controllers\LaravelCGController;
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

Route::get('/codeigniter', [CodeIgniterCGController::class, 'index'])->name('codeigniter.index');
Route::post('/getDBTables', [CodeIgniterCGController::class, 'getDBTables'])->name('codeigniter.getDBTables');
Route::post('/getTableColumns', [CodeIgniterCGController::class, 'getTableColumns'])->name('codeigniter.getTableColumns');

Route::get('/laravel', [LaravelCGController::class, 'index'])->name('laravel.index');