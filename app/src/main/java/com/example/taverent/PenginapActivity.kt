package com.example.taverent

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import com.example.taverent.databinding.ActivityPenginapBinding


class PenginapActivity : AppCompatActivity() {
    private lateinit var binding: ActivityPenginapBinding
    private lateinit var penginap: Penginap
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityPenginapBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        penginap = intent.getParcelableExtra<Penginap>("penginap") as Penginap
        val fragment = PenginapCariFragment()
        val bundle = Bundle()
        bundle.putParcelable("penginap",penginap)
        val id_penginap = intent.getStringExtra("id_penginap").toString()
        fragment.arguments = bundle
        supportFragmentManager.beginTransaction().replace(
            R.id.frag3,fragment
        ).setReorderingAllowed(true).commit()

        binding.bottomNavPenginap.setOnItemSelectedListener {
            when(it.itemId){
                R.id.searchitem->{
                    val fragment = PenginapCariFragment()
                    val bundle = Bundle()
                    bundle.putParcelable("penginap",penginap)
                    fragment.arguments = bundle
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.favorititem->{
                    val fragment = PenginapFavoritFragment()
                    val bundle = Bundle()
                    bundle.putParcelable("penginap",penginap)
                    fragment.arguments = bundle
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.homeitem->{
                    val fragment = PenginapHomeFragment()
                    val bundle = Bundle()
                    bundle.putParcelable("penginap",penginap)
                    fragment.arguments = bundle
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.chatitem->{
                    val fragment = PenginapChatFragment()
                    val bundle = Bundle()
                    bundle.putParcelable("penginap",penginap)
                    fragment.arguments = bundle
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
                R.id.accountitem->{
                    val fragment = PenginapAccountFragment()
                    val bundle = Bundle()
                    bundle.putParcelable("penginap",penginap)
                    bundle.putString("id_penginap",id_penginap)
                    fragment.arguments = bundle
                    supportFragmentManager.beginTransaction().replace(
                        R.id.frag3,fragment
                    ).setReorderingAllowed(true).commit()
                }
            }
            return@setOnItemSelectedListener true
        }
    }

    override fun onBackPressed() {
        val eBuilder = AlertDialog.Builder(this)
        eBuilder.setTitle("Exit")
        eBuilder.setIcon(R.drawable.ic_baseline_warning_24)
        eBuilder.setMessage("Are you sure you want to Exit ?, Press back again to abort")
        eBuilder.setPositiveButton("Yes"){
                Dialog, whichButton ->
            this.finishAffinity();
        }.show()
    }
}