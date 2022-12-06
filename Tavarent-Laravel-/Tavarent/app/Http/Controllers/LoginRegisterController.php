<?php

namespace App\Http\Controllers;
use App\Models\Penginap;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    function login(Request $request){
        return view('loginregister/login');
    }
    function Register(Request $request){
        return view('loginregister/register');
    }

    private function UserPenginap(){
        $users = Penginap::all();
        $return_data = [];
        foreach( $users as $row)
        {

            $return_data['users'][] =$row->getOriginal();
        }
        return $return_data;
    }
    private function UserPemilik(){
        $users = Pemilik::all();
        $return_data = [];
        foreach( $users as $row)
        {

            $return_data['users'][] =$row->getOriginal();
        }
        return $return_data;
    }

    function check(Request $request){
        $dataUserPenginap = $this->UserPenginap($request);
        $dataUserPemilik = $this->UserPemilik($request);
        $email = $request->email;
        $password = $request->password;
        $hidden = $request->hidden;
        $cekEmail = false;
        $cekPassword = false;
        if($hidden=="login"){
            if($dataUserPenginap != null){
                foreach($dataUserPenginap['users'] as $row)
                {
                    if($email == $row['email']){
                        $cekEmail = true;
                        if($password == $row['password'] ){
                            $cekPassword =true;
                            return view('Penyewa/home');
                        }
                    }
                }
            }
            if($dataUserPemilik != null){
                foreach($dataUserPemilik['users'] as $row)
                {
                    if($email == $row['email']){
                        $cekEmail = true;
                        if($password == $row['password'] ){
                            $cekPassword =true;
                            return view('Pemilik/home');
                        }
                    }
                }
            }
            if( $cekEmail == false){
                return redirect()->back()->withInput($request->only('email','password'))->withErrors([
                    'email' => 'Your Email is Invalid',
                ]);
            }else if($cekPassword == false){
                return redirect()->back()->withInput($request->only('email','password'))->withErrors([
                    'password' => 'Your Password is Invalid',
                ]);
            }
        }
        if($hidden=="register"){
            $cekPemilik = false;
            $cekPenginap = false;
            if($dataUserPenginap != null){
                foreach($dataUserPenginap['users'] as $row)
                {
                    if(str_contains($email,$row['email'])){
                        $cekEmail = true;
                    }
                }
            }
            if($dataUserPemilik != null){
                foreach($dataUserPemilik['users'] as $row)
                {
                    if(str_contains($email,$row['email'])){
                        $cekEmail = true;
                    }
                }
            }
            if($cekEmail){
                return redirect()->back()->withInput($request->only('email','username','password','notelp','nama'))->withErrors([
                    'email' => 'Email Taken',
                ]);
            }
            $rbjenis = $request->rbJenis;
            if( $rbjenis == "pemilik"){
                Pemilik::create(array(
                    "email" => $request->email,
                    "no_telp" => $request->notelp,
                    "username" => $request->username,
                    "nama_lengkap" => $request->nama,
                    "password" => $request->password,
                ));
            }
            else if( $rbjenis == "penginap"){
                Penginap::create(array(
                    "email" => $request->email,
                    "no_telp" => $request->notelp,
                    "username" => $request->username,
                    "nama_lengkap" => $request->nama,
                    "password" => $request->password,
                ));
            }
            else{
                return redirect()->back()->withInput($request->only('email','username','password','notelp','nama'))->withErrors([
                    'rbJenis' => 'Pilih salah satu',
                ]);
            }
            return view('loginregister/register');
        }
    }

}
