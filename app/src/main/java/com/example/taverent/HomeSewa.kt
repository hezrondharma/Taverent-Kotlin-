package com.example.taverent

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.Toast
import androidx.activity.result.ActivityResult
import androidx.activity.result.contract.ActivityResultContracts
import androidx.recyclerview.widget.GridLayoutManager
import androidx.recyclerview.widget.RecyclerView
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch


class HomeSewa : Fragment() {


    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_home_sewa, container, false)
    }
    private lateinit var pemilik: Pemilik
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        Log.e("tag",arguments.toString())
        pemilik = arguments?.getParcelable<Pemilik>("pemilik") as Pemilik


        val btnpindah = view.findViewById<ImageView>(R.id.btnTambahKosApartmen)
        btnpindah.setOnClickListener {
            val intent = Intent(view.context,TambahProperti::class.java)
            intent.putExtra("id_pemilik",pemilik.id)
            activity?.runOnUiThread { byResult.launch(intent) }
        }
    }
    val byResult = registerForActivityResult(ActivityResultContracts.StartActivityForResult()){
            result: ActivityResult ->
        if (result.resultCode == Activity.RESULT_OK){
            refreshPenginapan()
        }
    }

    fun refreshPenginapan(){

    }

}