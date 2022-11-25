package com.example.taverent

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.example.taverent.databinding.ActivityLoginBinding

class LoginActivity : AppCompatActivity() {
    private lateinit var binding: ActivityLoginBinding
    var WS_HOST = ""

    var pemiliks: ArrayList<Pemilik> = ArrayList()
    var penginaps: ArrayList<Penginap> = ArrayList()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityLoginBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        WS_HOST = resources.getString(R.string.WS_HOST)

        setfrag()
        binding.button2.setOnClickListener {
            val intent = Intent(this@LoginActivity, RegisterActivity::class.java)
            runOnUiThread {
                startActivity(intent)
            }
        }

    }
    fun setfrag(){
        val fragment = LoginChoose2()
        supportFragmentManager.beginTransaction().replace(
            R.id.frag1,fragment
        ).setReorderingAllowed(true).commit()
    }
}