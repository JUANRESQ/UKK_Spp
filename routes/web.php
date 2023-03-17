<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaLoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// login petugas dan siswa
Route::get('/', [LoginController::class, 'loginsiswa']);
Route::post('/loginsiswa', [LoginController::class, 'authUser']);
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'authenticate']);
route::get('/logout', [LoginController::class, 'logout']);
route::get('/logout/siswa', [LoginController::class, 'logout2']);

// isi petugas/ admin
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::resource('/dashboard/data-petugas', PetugasController::class);
Route::resource('/dashboard/entry-pembayaran', PembayaranController::class);
Route::resource('/dashboard/history-pembayaran', HistoryController::class);
Route::resource('/dashboard/data-kelas', KelasController::class);
Route::resource('/dashboard/data-siswa', SiswaController::class);
Route::resource('/dashboard/data-spp', SppController::class);


// isi siswa
route::get('/dashboardSiswa', [SiswaLoginController::class, 'index']);


// login dengan google
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);


