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
// Route::post('submit', [LoginRegisterController::class, 'check'])->name('check');
Route::get('/ts', function () {
    return view('ts');
});
Route::middleware(['cekLogin'])->group(function () {
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('login', [LoginRegisterController::class, 'login']);
    Route::get('register', [LoginRegisterController::class, 'register']);
    Route::post('login', [LoginRegisterController::class, 'doLogin']);
    Route::post('register', [LoginRegisterController::class, 'doRegister']);
});
Route::middleware(['cekUser'])->group(function () {
    Route::get('penyewa', [PenyewaController::class, 'PenyewaHome']);
    Route::get('penyewa/favorit', [PenyewaController::class, 'PenyewaFavorit']);
    Route::get('penyewa/kossaya', [PenyewaController::class, 'PenyewaKosSaya']);
    Route::get('penyewa/chat', [PenyewaController::class, 'PenyewaChat']);
    Route::get('penyewa/profil', [PenyewaController::class, 'PenyewaProfil']);
});
Route::post('logout', [LoginRegisterController::class, 'logout']);

Route::get('login', [LoginRegisterController::class, 'login']);
Route::get('register', [LoginRegisterController::class, 'register']);
Route::post('login', [LoginRegisterController::class, 'doLogin']);
Route::post('register', [LoginRegisterController::class, 'doRegister']);

Route::get('penyewa', [PenyewaController::class, 'PenyewaHome']);
Route::get('penyewa/search', [PenyewaController::class, 'PenyewaSearch']);
Route::get('penyewa/favorit', [PenyewaController::class, 'PenyewaFavorit']);
Route::get('penyewa/kossaya', [PenyewaController::class, 'PenyewaKosSaya']);
Route::get('penyewa/chat', [PenyewaController::class, 'PenyewaChat']);
Route::get('penyewa/profil', [PenyewaController::class, 'PenyewaProfil']);

Route::get('pemilik', [PemilikController::class, 'PemilikHome']);
Route::get('pemilik/chat', [PemilikController::class, 'PemilikChat']);
Route::get('pemilik/kelola', [PemilikController::class, 'PemilikKelola']);
Route::post('pemilik/kelola', [PemilikController::class, 'doPemilikKelola']);
Route::get('pemilik/statistik', [PemilikController::class, 'PemilikStatistik']);
Route::get('pemilik/profil', [PemilikController::class, 'PemilikProfil']);

Route::get('admin', [AdminController::class, 'AdminHome']);
Route::get('admin/listpenginap', [AdminController::class, 'AdminListPenginap']);
Route::get('admin/listpenginap/hapus/{id}', [AdminController::class, 'AdminHapusListPenginap']);
Route::get('admin/listpenginap/ubah/{id}',[AdminController::class,'AdminUbahListPenginap']);
Route::post('admin/listpenginap/ubah/{id}',[AdminController::class,'AdmindoUbahListPenginap']);
Route::get('admin/listpemilik', [AdminController::class, 'AdminListPemilik']);
Route::get('admin/listpemilik/hapus/{id}', [AdminController::class, 'AdminHapusListPemilik']);
Route::get('admin/listpemilik/ubah/{id}',[AdminController::class,'AdminUbahListPemilik']);
Route::post('admin/listpemilik/ubah/{id}',[AdminController::class,'AdmindoUbahListPemilik']);
Route::get('admin/laporan', [AdminController::class, 'AdminLaporan']);
Route::get('admin/listnotifikasi', [AdminController::class, 'AdminListNotifikasi']);
Route::post('admin/listnotifikasi', [AdminController::class, 'AdminTambahNotifikasi']);
Route::get('admin/listnotifikasi/hapus/{id}', [AdminController::class, 'AdminHapusNotifikasi']);
Route::get('admin/listnotifikasi/ubah/{id}',[AdminController::class,'AdminUbahNotifikasi']);
Route::post('admin/listnotifikasi/ubah/{id}',[AdminController::class,'AdmindoUbahNotifikasi']);
Route::get('testing', [AdminController::class,'testing']);

Route::middleware(['cekUser'])->group(function () {
    Route::get('pemilik', [PemilikController::class, 'PemilikHome']);
    Route::get('pemilik/chat', [PemilikController::class, 'PemilikChat']);
    Route::get('pemilik/kelola', [PemilikController::class, 'PemilikKelola']);
    Route::post('pemilik/kelola', [PemilikController::class, 'doPemilikKelola']);
    Route::get('pemilik/statistik', [PemilikController::class, 'PemilikStatistik']);
    Route::get('pemilik/profil', [PemilikController::class, 'PemilikProfil']);
    Route::get('pemilik/logout', [PemilikController::class, 'logoutpemilik']);
});

Route::middleware(['cekUser'])->group(function () {
    Route::get('admin', [AdminController::class, 'AdminHome']);
    Route::get('admin/list', [AdminController::class, 'AdminList']);
    Route::get('admin/game', [AdminController::class, 'AdminGame']);
    Route::get('admin/announce', [AdminController::class, 'AdminAnnounce']);
    Route::get('admin/profil', [AdminController::class, 'AdminProfil']);
    Route::get('testing', [AdminController::class,'testing']);
});
Route::get('testing', [AdminController::class, 'testing']);



