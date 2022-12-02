<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenyewaController;
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
    return redirect('login');
});
Route::get('login', [LoginRegisterController::class, 'Login']);
Route::get('register', [LoginRegisterController::class, 'Register']);
Route::get('penyewa', [PenyewaController::class, 'PenyewaHome']);
Route::get('penyewa/favorit', [PenyewaController::class, 'PenyewaFavorit']);
Route::get('penyewa/kossaya', [PenyewaController::class, 'PenyewaKosSaya']);
Route::get('penyewa/chat', [PenyewaController::class, 'PenyewaChat']);
Route::get('penyewa/profil', [PenyewaController::class, 'PenyewaProfil']);
Route::get('pemilik', [PemilikController::class, 'PemilikHome']);
Route::get('pemilik/chat', [PemilikController::class, 'PemilikChat']);
Route::get('pemilik/kelola', [PemilikController::class, 'PemilikKelola']);
Route::get('pemilik/statistik', [PemilikController::class, 'PemilikStatistik']);
Route::get('pemilik/profil', [PemilikController::class, 'PemilikProfil']);
Route::get('admin', [AdminController::class, 'AdminHome']);
Route::get('admin/list', [AdminController::class, 'AdminList']);
Route::get('admin/game', [AdminController::class, 'AdminGame']);
Route::get('admin/announce', [AdminController::class, 'AdminAnnounce']);
Route::get('admin/profil', [AdminController::class, 'AdminProfil']);


