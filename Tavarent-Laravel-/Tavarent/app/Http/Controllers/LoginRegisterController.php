<?php

namespace App\Http\Controllers;
use App\Models\Penginap;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginRegisterController extends Controller
{
    function logout(){
        Session::forget('cekuser');
        return redirect('/login');
    }
    function login(Request $request){
        Session::forget("login");
        return view('loginregister/login');
    }
    function register(Request $request){
        return view('loginregister/register');
    }
    private function getUserPemilik(Request $request){
        $users = Pemilik::all();
        $return_data = [];
        foreach( $users as $row)
        {
            $return_data['users'][] =$row->getOriginal();
        }
        return $return_data;
    }
    private function getUserPenginap(Request $request){
        $users = Penginap::all();
        $return_data = [];
        foreach( $users as $row)
        {
            $return_data['users'][] =$row->getOriginal();
        }
        return $return_data;
    }

    public function doLogin(Request $request)
    {
        Session::forget('cekuser');
        if(strtolower($request->email) == "admin"){
            if(strtolower($request->password) == "admin"){
                Session::put("cekuser","admin");
                return redirect("/admin");
            }
        }
        $dataPemilik = $this->getUserPemilik($request);
        $dataPenginap = $this->getUserPenginap($request);

        $request->validate([
            "email" => ["required","email"],
            "password"  => ["required"] ,
        ]);
        if($dataPemilik !=null){
            foreach( $dataPemilik['users'] as $row){
                if ( $row['email'] == $request->email ) {
                    if ($row['password'] == $request->password){
                        $pemilik = Pemilik::where("email","=",$request->email)->first();
                        Session::forget('pemilik');
                        Session::put("pemilik",$pemilik);
                        Session::put("cekuser","pemilik");
                        return redirect("/pemilik");
                    }
                }
            }
        }
        if($dataPenginap !=null){
            foreach( $dataPenginap['users'] as $row){
                if ( $row['email'] == $request->email ) {
                    if ($row['password'] == $request->password){
                        $penginap = Penginap::where("email","=",$request->email)->first();
                        Session::forget('penyewa');
                        Session::put("penyewa",$penginap);
                        Session::put("cekuser","penginap");
                        return redirect("/penyewa");
                    }
                }
            }
        }
        return redirect()->back();
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
