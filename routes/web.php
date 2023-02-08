<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;

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
// login petugas dan siswa
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/login-siswa', [LoginController::class, 'loginsiswa']);
Route::post('/loginsiswa', [LoginController::class, 'authUser']);

// isi
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::resource('/dashboard/data-petugas', PetugasController::class);
