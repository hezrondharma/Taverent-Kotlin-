package com.example.taverent

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.example.taverent.databinding.ActivityPenginapBinding

class PenginapActivity : AppCompatActivity() {
    private lateinit var binding: ActivityPenginapBinding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPenginapBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        val fragment = PenginapCariFragment()
        supportFragmentManager.beginTransaction().replace(
            R.id.frag3,fragment
        ).setReorderingAllowed(true).commit()

        binding.bottomNavPenginap.setOnItemSelectedListener {
            when(it.itemId){
                R.id.searchitem->{
                    val fragment = PenginapCariFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.favorititem->{
                    val fragment = PenginapFavoritFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.homeitem->{
                    val fragment = PenginapHomeFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.chatitem->{
                    val fragment = PenginapChatFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.accountitem->{
                    val fragment = PenginapAccountFragment()
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
            }
            return@setOnItemSelectedListener true
        }
    }
}