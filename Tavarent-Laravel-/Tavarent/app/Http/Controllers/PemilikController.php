<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Penginapan;
class PemilikController extends Controller
{
    function logoutpemilik(){
        Session::forget('cekuser');
        return redirect('/login');
    }
    function PemilikHome(){
        return view('pemilik/home');
    }

    function PemilikKelola(){
        return view('pemilik/kelola');
    }

    function doPemilikKelola(Request $request){
        $list = "";
        if($request->ac != null){
            $list=$list."Air Conditioner,";
        }if($request->termasuklistrik != null){
            $list=$list."Termasuk Listrik,";
        }if($request->kdalam != null){
            $list=$list."K. Mandi Dalam,";
        }if($request->kursi != null){
            $list=$list."Kursi,";
        }if($request->meja != null){
            $list=$list."Meja,";
        }if($request->wifi != null){
            $list=$list."Wifi,";
        }if($request->kasurdouble != null){
            $list=$list."Kasur Double,";
        }if($request->tv != null){
            $list=$list."Tv,";
        }if($request->kasursingle != null){
            $list=$list."Kasur Single,";
        }if($request->jendela != null){
            $list=$list."Jendela,";
        }if($request->airpanas != null){
            $list=$list."Air Panas,";
        }if($request->dapur != null){
            $list=$list."Dapur,";
        }
        Penginapan::create(array(
            "nama" =>$request->nproperti,
            "alamat" =>$request->alamat,
            "deskripsi" =>$request->deskripsi,
            "fasilitas" =>$list,
            "jk_boleh" =>$request->selector,
            "tipe" =>$request->rbJenis,
            "harga" =>$request->harga,
            "koordinat" =>"",
            "id_pemilik" =>"1",
        ));
        return view('pemilik/kelola');
    }
}
