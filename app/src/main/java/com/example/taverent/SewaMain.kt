package com.example.taverent

import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.util.Log
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.example.taverent.databinding.ActivitySewaMainBinding

class SewaMain : AppCompatActivity() {
    private lateinit var binding: ActivitySewaMainBinding
    private lateinit var pemilik: Pemilik
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySewaMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        pemilik = intent.getParcelableExtra<Pemilik>("pemilik") as Pemilik
        Log.e("tag",pemilik.toString())

        val fragreplace=HomeSewa()
        val bundle = Bundle()
        bundle.putParcelable("pemilik",pemilik)
        fragreplace.arguments = bundle
        val transaction = supportFragmentManager.beginTransaction().replace(
            R.id.frag4,fragreplace
        ).setReorderingAllowed(true).commit()

        binding.bottomNavSewa.setOnItemSelectedListener {
            when (it.itemId){
                R.id.btnHomeSewa->{
                    val fragreplace=HomeSewa()
                    val bundle = Bundle()
                    bundle.putParcelable("pemilik",pemilik)
                    fragreplace.arguments = bundle
                    val transaction = supportFragmentManager.beginTransaction().replace(
                        R.id.frag4,fragreplace
                    ).setReorderingAllowed(true).commit()
                }
                R.id.btnChatSewa->{
                    val fragreplace=ChatSewa()
                    val bundle = Bundle()
                    bundle.putParcelable("pemilik",pemilik)
                    fragreplace.arguments = bundle
                    val transaction = supportFragmentManager.beginTransaction().replace(
                        R.id.frag4,fragreplace
                    ).setReorderingAllowed(true).commit()
                }
                R.id.btnKelolaSewa->{
                    val fragreplace=KelolaSewa()
                    val bundle = Bundle()
                    bundle.putParcelable("pemilik",pemilik)
                    fragreplace.arguments = bundle
                    val transaction = supportFragmentManager.beginTransaction().replace(
                        R.id.frag4,fragreplace
                    ).setReorderingAllowed(true).commit()
                }
                R.id.btnStatistikSewa->{
                    val fragreplace=StatistikSewa()
                    val bundle = Bundle()
                    bundle.putParcelable("pemilik",pemilik)
                    fragreplace.arguments = bundle
                    val transaction = supportFragmentManager.beginTransaction().replace(
                        R.id.frag4,fragreplace
                    ).setReorderingAllowed(true).commit()
                }
                R.id.btnAkunSewa->{
                    val fragreplace=AkunSewa()
                    val bundle = Bundle()
                    bundle.putParcelable("pemilik",pemilik)
                    fragreplace.arguments = bundle
                    val transaction = supportFragmentManager.beginTransaction().replace(
                        R.id.frag4,fragreplace
                    ).setReorderingAllowed(true).commit()
                }
            }
            return@setOnItemSelectedListener true
        }
    }
}