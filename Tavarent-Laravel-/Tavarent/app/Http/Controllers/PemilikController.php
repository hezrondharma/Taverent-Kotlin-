<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    private function getUserPenginapan(Request $request){
        $users = Penginapan::all();
        $return_data = [];
        foreach( $users as $row)
        {
            $return_data['users'][] =$row->getOriginal();
        }
        return $return_data;
    }
    function doPemilikKelola(Request $request){
        
        $request->validate([
            "nproperti" => ["required"],
            "alamat" =>["required"],
            "deskripsi" =>["required"],
            "selector" =>["required"],
            "rbJenis" =>["required"],
            "harga" =>["required","numeric","min:1"],
            "koordinat" =>["required"],
            "photo"=>["required"],
            "photo.*"=>["mimes:jpg"]
        ],[
            "nproperti" => "Nama harus di isi",
            "alamat" => "Alamat harus di isi",
            "deskripsi" => "Harus ada deskripsi tambahan",
            "selector" => "Harus memilih jenis kelamin ",
            "rbJenis" => "Harus memilih tipe",
            "harga" => "Harus ada harga",
            "koordinat" => "Harus memilih alamat dari autosuggest",
        ]);
        $totalimage = 0;
        foreach($request->file('photo') as $photo){
            $totalimage++;
        }
        $list = "";
        $id_pemilik=Session::get('pemilik')->id;
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
            "koordinat" =>$request->koordinat,
            "jumlah_foto" =>$totalimage,
            "id_pemilik" =>$id_pemilik,
        ));

        $default=0;
        $dataPemilik = $this->getUserPenginapan($request);
        foreach( $dataPemilik['users'] as $row){
            $default=$row['id'];
        }
        $value =1 ;
        foreach($request->file('photo') as $photo){
            $path = $photo->storeAs("imagesPenginapan",$default.'_'.$value.'.jpg',"public");
            $value++;
        }
        return redirect('galeri/upload');
        return redirect('pemilik/kelola');
    }
}
