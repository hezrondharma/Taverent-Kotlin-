package com.example.taverent

import android.os.Parcelable
import kotlinx.parcelize.Parcelize
import java.util.*

@Parcelize
class Penginap(
    var id: Int,
    var username:String,
    var password:String,
    var nama_lengkap:String,
    var email:String,
    var no_telp:String,
    var deleted_at:String,
) : Parcelable {
}