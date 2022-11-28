package com.example.taverent

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.example.taverent.databinding.ActivityAdminBinding

class AdminActivity : AppCompatActivity() {
    private lateinit var binding: ActivityAdminBinding
    var WS_HOST = ""

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityAdminBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        WS_HOST = resources.getString(R.string.WS_HOST)

        val fragment = AdminHomeFragment()
        supportFragmentManager.beginTransaction().replace(
            R.id.frag2,fragment
        ).setReorderingAllowed(true).commit()
        binding.bottomNavAdmin.setOnItemSelectedListener {
            when (it.itemId){
                R.id.homeitem->{
                    val fragment = AdminHomeFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag2,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.listitem->{
                    val fragment = AdminListFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag2,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.gameitem->{

                }
                R.id.notifitem->{

                }
                R.id.adminitem->{

                }
            }
            return@setOnItemSelectedListener true
        }
    }


}