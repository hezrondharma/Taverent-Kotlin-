package com.example.taverent

import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.example.taverent.databinding.ActivitySewaMainBinding

class SewaMain : AppCompatActivity() {
    private lateinit var binding: ActivitySewaMainBinding
    var id_pemilik = ""
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySewaMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        id_pemilik = intent.getStringExtra("id_pemilik").toString()

        changefragment(HomeSewa())
        binding.bottomNavSewa.setOnItemSelectedListener {
            when (it.itemId){
                R.id.btnHomeSewa->{
                    changefragment(HomeSewa())
                }
                R.id.btnChatSewa->{
                    changefragment(ChatSewa())
                }
                R.id.btnKelolaSewa->{
                    changefragment(KelolaSewa())
                }
                R.id.btnStatistikSewa->{
                    changefragment(StatistikSewa())
                }
                R.id.btnAkunSewa->{
                    changefragment(AkunSewa())
                }
            }
            return@setOnItemSelectedListener true
        }
    }

    fun changefragment (fragments :Fragment){
        val fragreplace=fragments
        val bundle = Bundle()
        bundle.putString("id_pemilik",id_pemilik)
        fragreplace.arguments = bundle
        val transaction = supportFragmentManager.beginTransaction()
        transaction.replace(R.id.fragmentContainerView3, fragreplace)
        transaction.commit()
    }
}