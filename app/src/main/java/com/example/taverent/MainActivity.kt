package com.example.taverent

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.splashscreen.SplashScreen.Companion.installSplashScreen
import androidx.fragment.app.Fragment
import androidx.viewpager2.widget.ViewPager2
import com.example.taverent.databinding.ActivityMainBinding
import com.here.sdk.core.engine.SDKNativeEngine
import com.here.sdk.core.engine.SDKOptions
import com.here.sdk.core.errors.InstantiationErrorException


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

        initializeHERESDK()
        val fragments: ArrayList<Fragment> = arrayListOf(Onboarding1(),Onboarding2(),Onboarding3())
        pagerAdapter = ViewPagerAdapter(fragments,this@MainActivity)

        binding.viewPager.adapter = pagerAdapter
        binding.viewPager?.registerOnPageChangeCallback(object : ViewPager2.OnPageChangeCallback() {
            override fun onPageScrolled(
                position: Int,
                positionOffset: Float,
                positionOffsetPixels: Int,
            ) {
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

    override fun onDestroy() {
        super.onDestroy()
        disposeHERESDK()
    }

    private fun initializeHERESDK() {
        // Set your credentials for the HERE SDK.
        val accessKeyID = "HvBSWvTW-ajXnBs6abqRLw"
        val accessKeySecret = "5pdus4zHhrkbdIggtB8K5svsGc7BMGc2GZpJuX4XSQQXF16CSCRGmeqoJmRnfSdYtyjRACVFHzchzABZEmnGTQ"
        val options = SDKOptions(accessKeyID, accessKeySecret)
        try {
            SDKNativeEngine.makeSharedInstance(this@MainActivity, options)
        } catch (e: InstantiationErrorException) {
            throw RuntimeException("Initialization of HERE SDK failed: " + e.error.name.toString())
        }
    }
    private fun disposeHERESDK() {
        // Free HERE SDK resources before the application shuts down.
        // Usually, this should be called only on application termination.
        // Afterwards, the HERE SDK is no longer usable unless it is initialized again.
        val sdkNativeEngine: SDKNativeEngine? = SDKNativeEngine.getSharedInstance()
        if (sdkNativeEngine != null) {
            sdkNativeEngine.dispose()
            // For safety reasons, we explicitly set the shared instance to null to avoid situations,
            // where a disposed instance is accidentally reused.
            SDKNativeEngine.setSharedInstance(null)
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