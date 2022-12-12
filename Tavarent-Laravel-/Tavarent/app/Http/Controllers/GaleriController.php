<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function upload(Request $request){
        return view('Pemilik/kelola');
    }

    public function doUpload(Request $request){
        $value =1 ;
        $destinationPath = 'HomeImages';
        $myimage  = $request->photo->getClientOriginalName();
        $files = Storage::disk('public-folder')->allFiles();
        foreach($files as $cek){
            $value+=1;
        }
        $request->photo->move(public_path($destinationPath), $value.".jpg");
        return redirect('galeri/upload');
    }
}
