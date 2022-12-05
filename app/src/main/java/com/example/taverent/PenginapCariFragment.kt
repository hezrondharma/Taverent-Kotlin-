package com.example.taverent

import android.app.ActionBar
import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.AdapterView
import android.widget.LinearLayout
import android.widget.Spinner
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
    private lateinit var penginap: Penginap
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
    private lateinit var rvPenginapanPenginapCari: RVPenginapanPenginapCari
    private lateinit var rvJenisPenginapan: RVJenisPenginapan
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        WS_HOST = resources.getString(R.string.WS_HOST)

        penginap = arguments?.getParcelable<Penginap>("penginap") as Penginap
        refreshPenginapan(view)

        binding.tvHalo.text = "Halo "+ penginap.username

        val namajenis = arrayListOf<String>("Kamar Kos","Apartment","Voucher","Game")
        val imagejenis = arrayListOf<Int>(R.drawable.kamarkos,R.drawable.apartment,R.drawable.voucher,R.drawable.game)
        rvJenisPenginapan = RVJenisPenginapan(namajenis,imagejenis){view, idx ->

        }
        binding.rvTipeKamar.adapter = rvJenisPenginapan
        binding.rvTipeKamar.layoutManager = LinearLayoutManager(view.context,LinearLayoutManager.HORIZONTAL,false)




        rvPenginapanPenginapCari = RVPenginapanPenginapCari(penginapansSearch){view, idx ->
            val intent = Intent(view.context,PenginapanDetailActivity::class.java)
            intent.putExtra("penginapan",penginapansSearch[idx])
            intent.putExtra("penginap",penginap)
            startActivity(intent)
        }
        binding.rvPenginapan.adapter = rvPenginapanPenginapCari
        binding.rvPenginapan.layoutManager = GridLayoutManager(view.context,2)

        binding.editSearch.setOnClickListener{
            val intent = Intent(view.context,SearchActivity::class.java)
            intent.putExtra("penginap",penginap)
            startActivity(intent)
        }
        filterPenginapan()
        binding.spinner.onItemSelectedListener = object: AdapterView.OnItemSelectedListener{
            override fun onItemSelected(p0: AdapterView<*>?, p1: View?, p2: Int, p3: Long) {
                filterPenginapan()
            }
            override fun onNothingSelected(p0: AdapterView<*>?) {
                TODO("Not yet implemented")
            }
        }
    }
    fun filterPenginapan(){
        penginapansSearch.clear()
        for (i in 0 until penginapans.size){
            if (penginapans[i].jk_boleh==binding.spinner.selectedItem.toString()){
                penginapansSearch.add(penginapans[i])
            }
        }
        if (penginapansSearch.size>0){
            binding.linearbelumada.visibility = View.GONE
        }else{
            binding.linearbelumada.visibility = View.VISIBLE
        }
        rvPenginapanPenginapCari.notifyDataSetChanged()
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
                    var tipe = o.getString("tipe")
                    var harga = o.getString("harga").toInt()
                    var koordinat = o.getString("koordinat")
                    var id_pemilik = o.getInt("id_pemilik")
                    val p = Penginapan(id,nama,alamat,deskripsi,fasilitas,jk_boleh,tipe,harga,koordinat,id_pemilik)
                    penginapans.add(p)
                    filterPenginapan()
                    binding.rvPenginapan.layoutParams = LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT,LinearLayout.LayoutParams.WRAP_CONTENT)
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