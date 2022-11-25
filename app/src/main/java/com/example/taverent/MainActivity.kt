package com.example.taverent

import android.content.Intent
import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import androidx.core.splashscreen.SplashScreen.Companion.installSplashScreen
import androidx.fragment.app.Fragment
import androidx.viewpager.widget.ViewPager
import androidx.viewpager2.widget.ViewPager2
import com.example.taverent.databinding.ActivityMainBinding


class MainActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding
    private lateinit var pagerAdapter: ViewPagerAdapter
    var WS_HOST = ""

    var position = 0
    override fun onCreate(savedInstanceState: Bundle?) {
        val splashScreen = installSplashScreen()
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        WS_HOST = resources.getString(R.string.WS_HOST)


        val fragments: ArrayList<Fragment> = arrayListOf(Onboarding1(),Onboarding2(),Onboarding3())
        pagerAdapter = ViewPagerAdapter(fragments,this@MainActivity)

        binding.viewPager.adapter = pagerAdapter
        binding.viewPager?.registerOnPageChangeCallback(object : ViewPager2.OnPageChangeCallback() {
            override fun onPageScrolled(position: Int,
                                        positionOffset: Float,
                                        positionOffsetPixels: Int) {
                super.onPageScrolled(position, positionOffset, positionOffsetPixels)
                this@MainActivity.position = position
                if (position==2){
                    buttoncontinue()
                }else{
                    buttonnormal()
                }
            }
        })

        binding.btnNext.setOnClickListener {
            if (position<2){
                position++
                binding.viewPager.currentItem = position
            }
            if (position==2){
                buttoncontinue()
            }
            if (binding.btnNext.text=="Continue"){
                val intent = Intent(this@MainActivity, LoginActivity::class.java)
                runOnUiThread {
                    startActivity(intent)
                }
            }
            print(position.toString())
        }
        binding.btnSkip.setOnClickListener {
            position=2
            binding.viewPager.currentItem = position
            buttoncontinue()
        }

    }
    fun buttoncontinue(){
        binding.btnNext.animate().apply {
            duration = 200
            alpha(0f)
        }.withEndAction {
            binding.btnNext.text = "Continue"
            binding.btnNext.backgroundTintList = getColorStateList(R.color.black)
            binding.btnNext.animate().setListener(null).duration = 300
            binding.btnNext.animate().setListener(null).alpha(1f)
        }.start()
    }
    fun buttonnormal(){
        binding.btnNext.animate().apply {
            duration = 200
            alpha(0f)
        }.withEndAction {
            binding.btnNext.text = "Next"
            binding.btnNext.backgroundTintList = getColorStateList(R.color.white)
            binding.btnNext.animate().setListener(null).duration = 300
            binding.btnNext.animate().setListener(null).alpha(1f)
        }.start()
    }
}