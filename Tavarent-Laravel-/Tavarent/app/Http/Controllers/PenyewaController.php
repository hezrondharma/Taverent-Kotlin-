<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;

class PenyewaController extends Controller
{
    public function PenyewaHome(Request $request)
    {
        $param = [];
        $penginapan = Penginapan::all();

        $param["penginapan"] = $penginapan;
        return view('penyewa.cari',$param);
    }
}
