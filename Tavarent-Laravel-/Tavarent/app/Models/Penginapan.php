<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "penginapan";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ["nama","alamat","deskripsi","fasilitas","jk_boleh","id_pemilik"];
    public $timestamps = false;

    public function Promo()
    {
        $this->hasMany(Promo::class,'id_promo','id');
    }
    public function Pemilik()
    {
        $this->belongsTo(Pemilik::class,'id_pemilik','id');
    }
    public function Rating()
    {
        $this->hasMany(Rating::class,'id_rating','id');
    }
    public function Penginap()
    {
        $this->belongsToMany(Penginap::class,'penginap_history','id_penginapan','id_penginap');
    }
    
}
