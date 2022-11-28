package com.example.taverent

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.example.taverent.databinding.FragmentAdminAnnounceBinding
import com.example.taverent.databinding.FragmentAdminListBinding

class AdminAnnounceFragment : Fragment() {
    private lateinit var binding: FragmentAdminAnnounceBinding
    var WS_HOST = ""


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?,
    ): View? {
        // Inflate the layout for this fragment
        binding = FragmentAdminAnnounceBinding.inflate(layoutInflater)
        val view = binding.root
        return view
    }

    
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        WS_HOST = resources.getString(R.string.WS_HOST)


    }
}