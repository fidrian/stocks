<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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

Route::get("/", [LoginController::class, "index"]);
Route::post("/", [LoginController::class, "authenticate"]);
Route::get("/logout", [LoginController::class, "logout"]);
Route::post("/reset-password", [LoginController::class, "reset_password"]);
Route::get("/dashboard", [HomeController::class, "index"])->name("index");
Route::post("/stocks/update/{id}", [HomeController::class, "updateStocks"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
