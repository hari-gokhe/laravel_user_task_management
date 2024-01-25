<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
Route::resource('tasks', TaskController::class);
Route::resource('users', UserController::class);
Route::get('/login','App\Http\Controllers\LoginController@login')->name('login');
Route::post('/submit_login','App\Http\Controllers\LoginController@submit')->name('submit');
Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');