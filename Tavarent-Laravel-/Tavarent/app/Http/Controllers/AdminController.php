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
use App\Models\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function testing()
    {
        $pembayaran = Pembayaran::create(array(
            "total" => "1231231231",
            "tanggal_mulai" => "2022-12-06",
            "tanggal_selesai" => "2022-12-06",
            "id_penginap" => "1",
            "id_penginapan" => "3",
        ));
        dd($pembayaran);
    }
}
