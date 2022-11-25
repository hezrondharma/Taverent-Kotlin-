<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginap extends Model
{
    use HasFactory;
    protected $table = "penginap";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ["username","password","nama_lengkap","email","no_telp"];
    public $timestamps = false;

    public function Pembayaran()
    {
        $this->hasMany(Pembayaran::class,'id_pembayaran','id');
    }
    public function Kupon()
    {
        $this->hasMany(Kupon::class,'id_kupon','id');
    }
    public function Rating()
    {
        $this->hasMany(Rating::class,'id_rating','id');
    }
    public function Penginapan()
    {
        $this->belongsToMany(Penginapan::class,'penginap_history','id_penginap','id_penginapan');
    }
}
