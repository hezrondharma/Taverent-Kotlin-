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


    }
}