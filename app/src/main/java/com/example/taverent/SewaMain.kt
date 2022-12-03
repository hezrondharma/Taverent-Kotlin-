package com.example.taverent

import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.view.View
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.taverent.databinding.ActivitySewaMainBinding
import org.json.JSONArray

class SewaMain : AppCompatActivity() {
    private lateinit var binding: ActivitySewaMainBinding
    var id_pemilik = ""
    var username=""
    var nama_pemilik = ""
    var WS_HOST = ""
    var pemiliks: ArrayList<Pemilik> = ArrayList()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        WS_HOST = resources.getString(R.string.WS_HOST)
        binding = ActivitySewaMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        id_pemilik = intent.getStringExtra("id_pemilik").toString()
        nama_pemilik = intent.getStringExtra("nama_pemilik").toString()
        username= intent.getStringExtra("username").toString()
        changefragment(HomeSewa(),id_pemilik)
        binding.bottomNavSewa.setOnItemSelectedListener {
            when (it.itemId){
                R.id.btnHomeSewa->{

                    changefragment(HomeSewa(),id_pemilik)
                }
                R.id.btnChatSewa->{
                    changefragment(ChatSewa(),id_pemilik)
                }
                R.id.btnKelolaSewa->{
                    changefragment(KelolaSewa(),id_pemilik)
                }
                R.id.btnStatistikSewa->{
                    changefragment(StatistikSewa(),id_pemilik)
                }
                R.id.btnAkunSewa->{
                    changefragment(AkunSewa(),id_pemilik)
                }
            }
            return@setOnItemSelectedListener true
        }
    }

    fun changefragment (fragments :Fragment , pemilik:String){
        val bundle = Bundle()
        bundle.putString("id_pemilik",pemilik)
        bundle.putString("nama_pemilik",nama_pemilik)
        bundle.putString("username",username)
        fragments.arguments = bundle
        val transaction = supportFragmentManager.beginTransaction()
        transaction.replace(R.id.fragmentContainerView3, fragments)
        transaction.commit()
    }
}