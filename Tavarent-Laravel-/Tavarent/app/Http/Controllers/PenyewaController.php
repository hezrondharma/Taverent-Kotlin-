<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use Illuminate\Support\Facades\DB;

class PenyewaController extends Controller
{
    public function PenyewaHome(Request $request)
    {
        $param = [];
        $penginapan = Penginapan::all();

        $param["penginapan"] = $penginapan;
        return view('penyewa.cari',$param);
    }
    public function PenyewaSearch(Request $request)
    {
        $param = [];
        $penginapan = Penginapan::all();

        if ($request->lat!=""&&$request->lng!=""){
            $penginapan = Penginapan::selectRaw("*,ST_Distance_Sphere(
                POINT( $request->lng, $request->lat),
                POINT(SUBSTRING(koordinat,POSITION(',' IN koordinat)+1,LENGTH(koordinat)-POSITION(',' IN koordinat)+1),SUBSTR(koordinat,1,POSITION(',' IN koordinat)-1)))  AS 'distance'")
            ->whereRaw(DB::raw("ST_Distance_Sphere(
                POINT( $request->lng, $request->lat),
                POINT(SUBSTRING(koordinat,POSITION(',' IN koordinat)+1,LENGTH(koordinat)-POSITION(',' IN koordinat)+1),SUBSTR(koordinat,1,POSITION(',' IN koordinat)-1)))<=10000"))
             ->get();
        }

        $param["penginapan"] = $penginapan;
        $param["lat"] = $request->lat;
        $param["lng"] = $request->lng;
        $param["alamat"] = $request->alamat;
        $param["java"] = "<script>start();</script>";
        return view('penyewa.search',$param);
    }
    public function PenginapanDetail(Request $request)
    {
        $penginapan = Penginapan::find($request->id);

        $param["penginapan"] = $penginapan;
        return view("penyewa.penginapan",$param);
    }
}
