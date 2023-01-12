package com.example.taverent

import androidx.room.Entity
import androidx.room.PrimaryKey
import java.lang.reflect.Array

@Entity(tableName = "homepenginapan")
data class HomepenginapEntity(
    @PrimaryKey
    var id: Int,
    var nama: String,
    var alamat: String,
    var deskripsi: String,
    var fasilitas: String,
    var jk_boleh: String,
    var tipe: String,
    var harga: Int,
    var koordinat: String,
    var id_pemilik: Int,
){

}
