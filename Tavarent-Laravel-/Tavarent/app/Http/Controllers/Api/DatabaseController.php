<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penginap;
use App\Models\Pemilik;

class DatabaseController extends Controller
{
    public function listuser(Request $request)
    {
        $penginap = Penginap::all();
        $pemilik = Pemilik::all();
        $combine = $penginap->merge($pemilik);
        return response()->json($combine, 200);
    }
    public function listpenginap(Request $request)
    {
        $penginap = Penginap::all();
        return response()->json($penginap, 200);
    }
    public function listpemilik(Request $request)
    {
        $pemilik = Pemilik::all();
        return response()->json($pemilik, 200);
    }
    public function listpenginapan(Request $request)
    {
        return response()->json(Penginapan::all(), 200);
    }
    public function listkupon(Request $request)
    {
        return response()->json(Kupon::all(), 200);
    }
    public function listpromo(Request $request)
    {
        return response()->json(Promo::all(), 200);
    }
    public function listrating(Request $request)
    {
        return response()->json(Rating::all(), 200);
    }
    function insertpemilik(Request $request){
        $pemilik = Pemilik::create(array(
            "email" => $request->email,
            "no_telp" => $request->no_telp,
            "username" => $request->username,
            "nama_lengkap" => $request->nama_lengkap,
            "password" => $request->password,
        ));
        return response()->json($pemilik, 201);
    }
    function insertpenginap(Request $request){
        $penginap = Penginap::create(array(
            "email" => $request->email,
            "no_telp" => $request->no_telp,
            "username" => $request->username,
            "nama_lengkap" => $request->nama_lengkap,
            "password" => $request->password,
        ));
        return response()->json($penginap, 201);
    }
}
