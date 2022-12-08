<?php

namespace App\Http\Controllers;
use App\Models\Penginap;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginRegisterController extends Controller
{
    function login(Request $request){
        Session::forget("login");
        return view('loginregister/login');
    }
    function register(Request $request){
        return view('loginregister/register');
    }
    public function doLogin(Request $request)
    {
        $request->validate([
            "email" => ["required","email"],
            "password"  => ["required"] ,
            "rbJenis" =>["required"]
        ],[
            "rbJenis" => "Pilih salah satu"
        ]);
        Session::forget('cekuser');
        if ($request->rbJenis=="pemilik"){
            $pemilik = Pemilik::where("email","=",$request->email)->first();
            if ($pemilik->password == $request->password){
                Session::forget('pemilik');
                Session::put("pemilik",$pemilik);
                Session::put("cekuser","pemilik");
                return redirect("/pemilik");
            }else{
                return redirect()->back();
            }
        }else if ($request->rbJenis=="penginap"){
            $penginap = Penginap::where("email","=",$request->email)->first();
            if ($penginap->password == $request->password){
                Session::forget('penginap');
                Session::put("penginap",$penginap);
                Session::put("cekuser","penginap");
                return redirect("/penginap");

            }else{
                return redirect()->back();
            }
        }
    }

    public function doRegister(Request $request)
    {
        if ($request->rbJenis!=""){
            if ($request->rbJenis=="pemilik"){
                $request->validate([
                    "email" => ["required","email","unique:App\Models\Pemilik,email"],
                    "username" => ["required","unique:App\Models\Pemilik,username","unique:App\Models\Penginap,username"],
                    "notelp" => ['numeric','min_digits:10','max_digits:12','unique:App\Models\Pemilik,no_telp'],
                    "nama" => ["required"],
                    "password"  => ["required"]
                ]);

                $res = Pemilik::create(array(
                    "email" => $request->email,
                    "no_telp" => $request->notelp,
                    "username" => $request->username,
                    "nama_lengkap" => $request->nama,
                    "password" => $request->password,
                ));
                return redirect("/login");
            }else if ($request->rbJenis=="penginap"){
                $request->validate([
                    "email" => ["required","email","unique:App\Models\Penginap,email"],
                    "username" => ["required","unique:App\Models\Penginap,username","unique:App\Models\Pemilik,username"],
                    "notelp" => ['numeric','min_digits:10','max_digits:12','unique:App\Models\Penginap,no_telp'],
                    "nama" => ["required"],
                    "password"  => ["required"]
                ]);
                $res = Penginap::create(array(
                    "email" => $request->email,
                    "no_telp" => $request->notelp,
                    "username" => $request->username,
                    "nama_lengkap" => $request->nama,
                    "password" => $request->password,
                ));
                return redirect("/login");
            }
        }else{
            return redirect()->back()->withErrors(["rbJenis"=>"Pilih salah satu"]);
        }
    }

}
