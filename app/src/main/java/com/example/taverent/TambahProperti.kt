package com.example.taverent

import android.content.res.ColorStateList
import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.widget.TextView
import android.widget.Toast
import com.example.taverent.databinding.ActivityTambahPropertiBinding

class TambahProperti : AppCompatActivity() {
    lateinit var tx:TextView
    private lateinit var binding: ActivityTambahPropertiBinding
    lateinit var list:ArrayList<Boolean>
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityTambahPropertiBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        list = arrayListOf(true,true,true,true,true,true,true,true,true,true,true,true)
        val listfasilitas = arrayListOf("Air Conditioner","K. Mandi Dalam","Termasuk Listrik","Wifi","Kursi","Meja","Tv","Kasur Single","Kasur Double","Air Panas","Jendela","Dapur")
        binding.btnF1.setOnClickListener {
            changecolor(binding,list,0)
        }
        binding.btnF2.setOnClickListener {
            changecolor(binding,list,1)
        }
        binding.btnF3.setOnClickListener {
            changecolor(binding,list,2)
        }
        binding.btnF4.setOnClickListener {
            changecolor(binding,list,3)
        }
        binding.btnF5.setOnClickListener {
            changecolor(binding,list,4)
        }
        binding.btnF6.setOnClickListener {
            changecolor(binding,list,5)
        }
        binding.btnF7.setOnClickListener {
            changecolor(binding,list,6)
        }
        binding.btnF8.setOnClickListener {
            changecolor(binding,list,7)
        }
        binding.btnF9.setOnClickListener {
            changecolor(binding,list,8)
        }
        binding.btnF10.setOnClickListener {
            changecolor(binding,list,9)
        }
        binding.btnF11.setOnClickListener {
            changecolor(binding,list,10)
        }
        binding.btnF12.setOnClickListener {
            changecolor(binding,list,11)
        }


        binding.btnTambahProperti.setOnClickListener {
            var ListFasilitas = ""
            for (i in 0 until listfasilitas.size){
                if(list[i] == false){
                    ListFasilitas= ListFasilitas + listfasilitas[i]
                }
            }
            Toast.makeText(this, ListFasilitas, Toast.LENGTH_SHORT).show()
        }

    }



    fun changecolor (bind:ActivityTambahPropertiBinding,lists:ArrayList<Boolean>, j:Int){
        val pass=false
        val altColor = Color.parseColor("#2DCA0A")
        val nextColor1 = if (pass == true) altColor else altColor
        val nextColor2 = if (pass == true) altColor else Color.parseColor("#FF0000")
        var btn = bind.btnF1
        if(j==0){
            btn = bind.btnF1
        }else if(j==1){
            btn = bind.btnF2
        }else if(j==2){
            btn = bind.btnF3
        }else if(j==3){
            btn = bind.btnF4
        }else if(j==4){
            btn = bind.btnF5
        }else if(j==5){
            btn = bind.btnF6
        }else if(j==6){
            btn = bind.btnF7
        }else if(j==7){
            btn = bind.btnF8
        }else if(j==8){
            btn = bind.btnF9
        }else if(j==9){
            btn = bind.btnF10
        }else if(j==10){
            btn = bind.btnF11
        }else if(j==11){
            btn = bind.btnF12
        }
        for(i in 0 until lists.size){
            if(i == j){
                if(lists[i]==true) {
                    btn.backgroundTintList = ColorStateList.valueOf(nextColor1)
                    lists[i]=false
                }else{
                    btn.backgroundTintList = ColorStateList.valueOf(nextColor2)
                    lists[i]=true
                }
            }
        }
    }
}