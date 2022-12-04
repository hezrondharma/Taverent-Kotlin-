<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginap;
use App\Models\Penginapan;
use App\Models\Pemilik;
use App\Models\Pengumuman;
use App\Models\Promo;
use App\Models\Kupon;
use App\Models\Rating;
use App\Models\Pembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function testing(){
        $pemilik=Pemilik::find(4);
        $pemilik->update([
            "username"=>"hezron",
            "password"=>"123",
            "nama_lengkap"=>"123",
            "no_telp"=>"123",
        ]);
    }
}
