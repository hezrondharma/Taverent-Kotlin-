<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    function login(Request $request){
        return view('loginregister/login');
    }
}
