package com.example.taverent

import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.recyclerview.widget.GridLayoutManager
import androidx.recyclerview.widget.LinearLayoutManager
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.taverent.databinding.FragmentPenginapCariBinding
import com.example.taverent.databinding.FragmentPenginapHomeBinding
import org.json.JSONArray

class PenginapCariFragment : Fragment() {
    private lateinit var binding: FragmentPenginapCariBinding
    var WS_HOST = ""

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?,
    ): View? {
        // Inflate the layout for this fragment
        binding = FragmentPenginapCariBinding.inflate(layoutInflater)
        val view = binding.root
        return view
    }

    var penginapans: ArrayList<Penginapan> = ArrayList()
    var penginapansSearch: ArrayList<Penginapan> = ArrayList()
    private lateinit var rvPenginapanAdminHome: RVPenginapanAdminHome
    private lateinit var rvJenisPenginapan: RVJenisPenginapan
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        WS_HOST = resources.getString(R.string.WS_HOST)

        refreshPenginapan(view)

        val namajenis = arrayListOf<String>("Kamar Kos","Apartment","Voucher","Game")
        val imagejenis = arrayListOf<Int>(R.drawable.kamarkos,R.drawable.apartment,R.drawable.voucher,R.drawable.game)
        rvJenisPenginapan = RVJenisPenginapan(namajenis,imagejenis){view, idx ->

        }
        binding.rvTipeKamar.adapter = rvJenisPenginapan
        binding.rvTipeKamar.layoutManager = LinearLayoutManager(view.context,LinearLayoutManager.HORIZONTAL,false)


        rvPenginapanAdminHome = RVPenginapanAdminHome(penginapans,R.layout.rv_penginapan_admin){view, idx ->

        }
        binding.rvPenginapan.adapter = rvPenginapanAdminHome
        binding.rvPenginapan.layoutManager = GridLayoutManager(view.context,2)

        binding.editSearch.setOnClickListener{
            val intent = Intent(view.context,SearchActivity::class.java)
            startActivity(intent)
        }

    }
    fun refreshPenginapan(view:View){
        val strReq = object : StringRequest(
            Method.GET,"$WS_HOST/penginapan/list",
            Response.Listener {
                val obj: JSONArray = JSONArray(it)
                penginapans.clear()
                for (i in 0 until obj.length()){
                    val o = obj.getJSONObject(i)
                    val id = o.getInt("id")
                    val nama = o.getString("nama")
                    val alamat = o.getString("alamat")
                    val deskripsi = o.getString("deskripsi")
                    val fasilitas = o.getString("fasilitas")
                    var jk_boleh = o.getString("jk_boleh")
                    var id_pemilik = o.getInt("id_pemilik")
                    val p = Penginapan(id,nama,alamat,deskripsi,fasilitas,jk_boleh,id_pemilik)
                    penginapans.add(p)
                    rvPenginapanAdminHome.notifyDataSetChanged()
                }
            },
            Response.ErrorListener {
                Toast.makeText(view.context, "WS_ERROR1", Toast.LENGTH_SHORT).show()
            }
        ){}
        val queue: RequestQueue = Volley.newRequestQueue(view.context)
        queue.add(strReq)
    }
}