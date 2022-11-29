<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DatabaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/semuauser",[DatabaseController::class, "listuser"]);
Route::get("/penginap/list",[DatabaseController::class, "listpenginap"]);
Route::post("/penginap/insert",[DatabaseController::class, "insertpenginap"]);

Route::get("/pemilik/list",[DatabaseController::class, "listpemilik"]);
Route::post("/pemilik/insert",[DatabaseController::class, "insertpemilik"]);

Route::get("/penginapan/list",[DatabaseController::class, "listpenginapan"]);

Route::get("/pengumuman/list",[DatabaseController::class, "listpengumuman"]);
Route::post("/pengumuman/insert",[DatabaseController::class, "insertpengumuman"]);

Route::get("/kupon/list",[DatabaseController::class, "listkupon"]);
Route::get("/promo/list",[DatabaseController::class, "listpromo"]);
Route::get("/rating/list",[DatabaseController::class, "listrating"]);
