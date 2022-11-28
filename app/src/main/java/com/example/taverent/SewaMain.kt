package com.example.taverent

import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.ConditionVariable
import android.widget.Toast
import com.example.taverent.databinding.ActivitySewaMainBinding

class SewaMain : AppCompatActivity() {
    private lateinit var binding: ActivitySewaMainBinding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivitySewaMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)
        binding.btnHomeSewa.setOnClickListener {
            Toast.makeText(this, "home", Toast.LENGTH_SHORT).show()
            gray(binding)
            binding.imHomeSewa.setImageResource(R.drawable.ic_baseline_home_24)
            binding.txHomeSewa.setTextColor(Color.parseColor("#000000"))
        }
        binding.btnChatSewa.setOnClickListener {
            Toast.makeText(this, "chat", Toast.LENGTH_SHORT).show()
            gray(binding)
            binding.imChatSewa.setImageResource(R.drawable.ic_baseline_chat_24)
            binding.txChatSewa.setTextColor(Color.parseColor("#000000"))
        }
        binding.btnKelolaSewa.setOnClickListener {
            Toast.makeText(this, "kelola", Toast.LENGTH_SHORT).show()
            gray(binding)
            binding.imKelolaSewa.setImageResource(R.drawable.ic_baseline_settings_cell_24)
            binding.txKelolaSewa.setTextColor(Color.parseColor("#000000"))
        }
        binding.btnStatistikSewa.setOnClickListener {
            Toast.makeText(this, "Statistik", Toast.LENGTH_SHORT).show()
            gray(binding)
            binding.imStatistikSewa.setImageResource(R.drawable.ic_baseline_insert_chart_outlined_24)
            binding.txStatistikSewa.setTextColor(Color.parseColor("#000000"))
        }
        binding.btnAkunSewa.setOnClickListener {
            Toast.makeText(this, "Akun", Toast.LENGTH_SHORT).show()
            gray(binding)
            binding.imAkunSewa.setImageResource(R.drawable.ic_baseline_person_24)
            binding.txAkunSewa.setTextColor(Color.parseColor("#000000"))
        }
    }

    fun gray(bind: ActivitySewaMainBinding){
        bind.imHomeSewa.setImageResource(R.drawable.ic_baseline_homegray_24)
        bind.imChatSewa.setImageResource(R.drawable.ic_baseline_chatgray_24)
        bind.imKelolaSewa.setImageResource(R.drawable.ic_baseline_settingsgray_cell_24)
        bind.imStatistikSewa.setImageResource(R.drawable.ic_baseline_insert_chartgray_outlined_24)
        bind.imAkunSewa.setImageResource(R.drawable.ic_baseline_persongray_24)
        bind.txHomeSewa.setTextColor(Color.parseColor("#C9C9C9"))
        bind.txChatSewa.setTextColor(Color.parseColor("#C9C9C9"))
        bind.txKelolaSewa.setTextColor(Color.parseColor("#C9C9C9"))
        bind.txStatistikSewa.setTextColor(Color.parseColor("#C9C9C9"))
        bind.txAkunSewa.setTextColor(Color.parseColor("#C9C9C9"))

    }
}