<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "pembayaran";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ["total","tanggal","id_penginap","id_penginapan","id_kupon","id_promo"];
    public $timestamps = false;

    public function Kupon()
    {
        $this->belongsTo(Kupon::class,'id_kupon','id');
    }
    public function Penginap()
    {
        $this->belongsTo(Penginap::class,'id_penginap','id');
    }
    public function Penginapan()
    {
        $this->belongsTo(Penginapan::class,'id_penginapan','id');
    }
    public function Promo()
    {
        $this->belongsTo(Promo::class,'id_promo','id');
    }
}
