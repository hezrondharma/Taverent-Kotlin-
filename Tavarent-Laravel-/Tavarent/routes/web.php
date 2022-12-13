<?php
use App\Http\Controllers\GaleriController;
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
Route::post('logout', [LoginRegisterController::class, 'logout']);
Route::middleware(['cekLogin'])->group(function () {
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('login', [LoginRegisterController::class, 'login']);
    Route::get('register', [LoginRegisterController::class, 'register']);
    Route::post('login', [LoginRegisterController::class, 'doLogin']);
    Route::post('register', [LoginRegisterController::class, 'doRegister']);
});
Route::middleware(['cekUserPenyewa'])->group(function () {
    Route::get('penyewa', [PenyewaController::class, 'PenyewaHome']);
    Route::get('penyewa/search/{lat?}/{lng?}/{alamat?}', [PenyewaController::class, 'PenyewaSearch']);
    Route::get('penyewa/penginapan/{id}', [PenyewaController::class, 'PenginapanDetail']);
    Route::get('penyewa/favorit', [PenyewaController::class, 'PenyewaFavorit']);
    Route::get('penyewa/kossaya', [PenyewaController::class, 'PenyewaKosSaya']);
    Route::get('penyewa/chat', [PenyewaController::class, 'PenyewaChat']);
    Route::get('penyewa/profil', [PenyewaController::class, 'PenyewaProfil']);
});

Route::middleware(['cekUserPemilik'])->group(function () {
    Route::get('pemilik', [PemilikController::class, 'PemilikHome']);
    Route::get('pemilik/chat', [PemilikController::class, 'PemilikChat']);
    Route::get('pemilik/kelola', [PemilikController::class, 'PemilikKelola']);
    Route::post('pemilik/kelola', [PemilikController::class, 'doPemilikKelola']);
    Route::get('pemilik/statistik', [PemilikController::class, 'PemilikStatistik']);
    Route::get('pemilik/profil', [PemilikController::class, 'PemilikProfil']);
    Route::get('pemilik/logout', [PemilikController::class, 'logoutpemilik']);
});
Route::prefix("galeri")->group(function(){
    Route::get('upload', [GaleriController::class, "upload"]);
    Route::post('doUpload', [GaleriController::class, "doUpload"]);
    Route::get('download/{namafile}', [GaleriController::class, 'download']);
});
Route::get('admin', [AdminController::class, 'AdminHome']);
Route::get('admin/list', [AdminController::class, 'AdminList']);
Route::get('admin/game', [AdminController::class, 'AdminGame']);
Route::get('admin/announce', [AdminController::class, 'AdminAnnounce']);
Route::get('admin/profil', [AdminController::class, 'AdminProfil']);
Route::get('testing', [AdminController::class,'testing']);




