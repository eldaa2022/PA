<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KontakController;
use App\Http\Controllers\API\KurikulumController;
use App\Http\Controllers\API\PesanController;
use App\Http\Controllers\API\DosenController;
use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\KontenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::post('kontak/store', [KontakController::class, 'store']);
Route::get('kontak/index', [KontakController::class, 'index']);
Route::get('kontak/{id}', [KontakController::class, 'show']);
Route::post('kontak/update', [KontakController::class, 'update']);


Route::post('kurikulum/store', [KurikulumController::class, 'store']);
Route::get('kurikulum/index', [KurikulumController::class, 'index']);
Route::get('kurikulum/{id}', [KurikulumController::class, 'show']);
Route::post('kurikulum/update', [KurikulumController::class, 'update']);


Route::post('pesan/store', [PesanController::class, 'store']);
Route::get('pesan/index', [PesanController::class, 'index']);
Route::get('pesan/{id}', [PesanController::class, 'show']);
Route::post('pesan/update', [PesanController::class, 'update']);


Route::post('dosen/store', [DosenController::class, 'store']);
Route::get('dosen/index', [DosenController::class, 'index']);
Route::get('dosen/{id}', [DosenController::class, 'show']);
Route::post('dosen/update', [DosenController::class, 'update']);



Route::post('agenda/store', [AgendaController::class, 'store']);
Route::get('agenda/index', [AgendaController::class, 'index']);
Route::get('agenda/{id}', [AgendaController::class, 'show']);
Route::post('agenda/update', [AgendaController::class, 'update']);



Route::post('konten/store', [KontenController::class, 'store']);
Route::get('konten/index', [KontenController::class, 'index']);
Route::get('konten/{id}', [KontenController::class, 'show']);
Route::post('konten/update', [KontenController::class, 'update']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
