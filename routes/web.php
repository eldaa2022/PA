<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KontakController;
use Illuminate\Support\Facades\Route;

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



// Route bisa diakses jika sudah melakukan login
Route::get('/test', [AuthController::class, 'test'])->name('test');

Route::get('/token', [AuthController::class, 'token'])->name('token');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/kontak', [App\Http\Controllers\KontakController::class, 'index']);
//Route::post('/store', [KontakController::class, 'store'])->name('store');


Route::middleware('auth')->group(function () {

});
