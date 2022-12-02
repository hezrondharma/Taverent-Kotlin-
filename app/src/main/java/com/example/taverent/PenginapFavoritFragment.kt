package com.example.taverent

import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.taverent.databinding.FragmentPenginapFavoritBinding
import com.example.taverent.databinding.FragmentPenginapHomeBinding
import org.json.JSONArray

class PenginapFavoritFragment : Fragment() {
    private lateinit var binding: FragmentPenginapFavoritBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?,
    ): View? {
        // Inflate the layout for this fragment
        binding = FragmentPenginapFavoritBinding.inflate(layoutInflater)
        val view = binding.root
        return view
    }

    private lateinit var rvPenginapanPenginapanFavorit: RVPenginapanPenginapanFavorit
    private lateinit var penginapans: ArrayList<Penginapan>
    var WS_HOST = ""
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        WS_HOST = resources.getString(R.string.WS_HOST)
        penginapans = ArrayList()
        rvPenginapanPenginapanFavorit = RVPenginapanPenginapanFavorit(penginapans,R.layout.rv_penginapan_favorit){view, idx->
            val intent = Intent(view.context,PenginapanDetailActivity::class.java)
            intent.putExtra("penginapan",penginapans[idx])
            startActivity(intent)
        }
        refreshPenginapan(view)
    }
    fun refreshPenginapan(view:View){
        val strReq = object : StringRequest(
            Method.GET,"$WS_HOST/penginapan/list/favorit",
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
                    var tipe = o.getString("tipe")
                    var harga = o.getString("harga").toInt()
                    var koordinat = o.getString("koordinat")
                    var id_pemilik = o.getInt("id_pemilik")
                    val p = Penginapan(id,nama,alamat,deskripsi,fasilitas,jk_boleh,tipe,harga,koordinat,id_pemilik)
                    penginapans.add(p)
                    rvPenginapanPenginapanFavorit.notifyDataSetChanged()
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