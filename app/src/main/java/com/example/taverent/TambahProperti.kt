package com.example.taverent

import android.content.res.ColorStateList
import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.widget.TextView
import com.example.taverent.databinding.ActivityTambahPropertiBinding

class TambahProperti : AppCompatActivity() {
    lateinit var tx:TextView
    private lateinit var binding: ActivityTambahPropertiBinding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityTambahPropertiBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        val pass=false
        val altColor = Color.parseColor("#2DCA0A")
        val nextColor1 = if (pass == true) altColor else altColor
        val nextColor2 = if (pass == true) altColor else Color.parseColor("#FF0000")
        var clicked=true;

        binding.btnF1.setOnClickListener {
            if(clicked==true) {
                binding.btnF1.backgroundTintList = ColorStateList.valueOf(nextColor1)
                clicked=false
            }else{
                binding.btnF1.backgroundTintList = ColorStateList.valueOf(nextColor2)
                clicked=true
            }
        }

    }
}