<?php

namespace App\Http\Controllers;

use App\Models\Penginap;
use Illuminate\Http\Request;
use App\Models\Penginapan;
use App\Models\Chat;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PenyewaController extends Controller
{
    public function PenyewaHome(Request $request)
    {
        $param = [];
        $penginapan = Penginapan::all();

        $param["penginapan"] = $penginapan;
        $param["photos"] = Storage::disk('public')->files('imagesPenginapan');
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
        $param["photos"] = Storage::disk('public')->files('imagesPenginapan');
        $param["java"] = "<script>start();</script>";
        $param["fav"] = (int)count(Penginap::find(Session::get("penyewa")->id)
        ->Penginapan()
        ->where("penginapan.id","=",$request->id)
        ->get());
        return view("penyewa.penginapan",$param);
    }
    public function ToggleFavorit(Request $request)
    {
        $exist = "";
        $penginapan = Penginap::find($request->id_penginap)->Penginapan()->where("penginapan.id","=",$request->id_penginapan)->first();
        if ($penginapan==null){
            $p = Penginapan::find($request->id_penginapan);
            $favorit = Penginap::find($request->id_penginap)->Penginapan()->attach($p);
            $exist = "bukanfavorit";
        }else{
            $p = Penginapan::find($request->id_penginapan);
            $favorit = Penginap::find($request->id_penginap)->Penginapan()->detach($p);
        }
        return redirect()->back();
    }
    public function PenyewaFavorit()
    {
        $param = [];
        $param["penginapan"] = Penginap::find(Session::get("penyewa")->id)->Penginapan()->get();

        return view("penyewa.favorit",$param);
    }
    public function PenyewaChat()
    {
        $param = [];
        $param["chat"] = Chat::where("chat.id_penginap","=",Session::get("penyewa")->id)
        ->get();
        return view('penyewa.chat',$param);
    }
    public function PenyewaChatPemilik(Request $request)
    {
        $param = [];
        $param["pemilik"] = Pemilik::find($request->id);
        $param["chat"] = Chat::where("chat.id_penginap","=",Session::get("penyewa")->id)
        ->where("chat.id_pemilik","=",$request->id)->get();
        return view('penyewa.chat',$param);
    }
    public function sendchat(Request $request)
    {
        $chat = Chat::create(array(
            "pesan" => $request->chat,
            "id_penginap" => Session::get("penyewa")->id,
            "id_pemilik" => $request->id,
            "sender" => "penginap",
            "status" => "",
        ));

        return redirect()->back();
    }
}

