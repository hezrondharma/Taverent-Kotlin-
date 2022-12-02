package com.example.taverent

import android.content.ContentValues.TAG
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.ImageButton
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.taverent.CurrencyUtils.toRupiah
import com.google.android.material.chip.Chip
import com.google.android.material.chip.ChipGroup
import com.here.sdk.core.GeoCoordinates
import com.here.sdk.core.LanguageCode
import com.here.sdk.core.engine.SDKNativeEngine
import com.here.sdk.core.engine.SDKOptions
import com.here.sdk.core.errors.InstantiationErrorException
import com.here.sdk.mapviewlite.*
import com.here.sdk.search.*
import org.json.JSONArray

class PenginapanDetailActivity : AppCompatActivity() {
    private lateinit var mainImage: ImageView
    private lateinit var tvNama: TextView
    private lateinit var tvJKboleh: TextView
    private lateinit var tvLokasi: TextView
    private lateinit var tvJKPenginapanDetail: TextView
    private lateinit var tvTipePenginapanDetail: TextView
    private lateinit var fasilitas: ChipGroup
    private lateinit var tvDeskripsiPenginapanDetail: TextView
    private lateinit var tvHargaPenginapanDetail: TextView
    private lateinit var btnBack: ImageButton
    private lateinit var btnFavorit: ImageButton
    private lateinit var mapView: MapViewLite
    private lateinit var penginapan: Penginapan
    private lateinit var penginap: Penginap
    private lateinit var mapMarker: MapMarker
    private lateinit var searchEngine: SearchEngine
    var WS_HOST = ""

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        initializeHERESDK()

        setContentView(R.layout.activity_penginapan_detail)
        WS_HOST = resources.getString(R.string.WS_HOST)
        penginapan = intent.getParcelableExtra<Penginapan>("penginapan")  as Penginapan
        penginap = intent.getParcelableExtra<Penginap>("penginap")  as Penginap
        checkFavorit(penginap.id,penginapan.id)

        mainImage = findViewById(R.id.imageView19)
        tvNama = findViewById(R.id.tvNama)
        tvJKboleh = findViewById(R.id.tvJkboleh2)
        tvLokasi = findViewById(R.id.tvLokasi)
        tvJKPenginapanDetail = findViewById(R.id.tvJKPenginapanDetail)
        tvTipePenginapanDetail = findViewById(R.id.tvTipePenginapanDetail)
        tvHargaPenginapanDetail = findViewById(R.id.tvHargaPenginapanDetail)
        fasilitas = findViewById(R.id.chipgroup)
        tvDeskripsiPenginapanDetail = findViewById(R.id.tvDeskripsiPenginapanDetail)
        btnBack = findViewById(R.id.btnBack)
        btnFavorit = findViewById(R.id.btnFavorit)
        mapView = findViewById(R.id.map_view)
        mapView.onCreate(savedInstanceState)

        tvNama.text = penginapan.nama
        tvJKboleh.text = penginapan.jk_boleh
        tvLokasi.text = penginapan.alamat
        tvJKPenginapanDetail.text = penginapan.jk_boleh
        tvTipePenginapanDetail.text = penginapan.tipe
        var fasilitasString = penginapan.fasilitas.substring(0,penginapan.fasilitas.length-1).split(",")
        for (i in fasilitasString.indices){
            val chip: Chip = Chip(this@PenginapanDetailActivity)
            chip.text = fasilitasString[i]
            fasilitas.addView(chip)
        }
        tvDeskripsiPenginapanDetail.text = penginapan.deskripsi
        tvHargaPenginapanDetail.text = penginapan.harga.toRupiah()
        val latitude = penginapan.koordinat.substring(0,penginapan.koordinat.indexOf(','))
        val longitude = penginapan.koordinat.substring(penginapan.koordinat.indexOf(',')+1,penginapan.koordinat.length-1)
        val geoCoordinates = GeoCoordinates(latitude.toDouble(),longitude.toDouble())
        loadMapScene(geoCoordinates)

        btnBack.setOnClickListener{
            finish()
        }
        btnFavorit.setOnClickListener{

            toggleFavorit(penginap.id,penginapan.id)
        }

    }

    fun checkFavorit(id_penginap:Int,id_penginapan:Int){
        val strReq = object : StringRequest(
            Method.POST,"$WS_HOST/penginapan/check/favorit",
            Response.Listener {
                if (it.toString()!="[]") {
                    btnFavorit.imageTintList = resources.getColorStateList(R.color.red)
                }else{
                    btnFavorit.imageTintList = resources.getColorStateList(R.color.black)
                }
            },
            Response.ErrorListener {
                Toast.makeText(this, "WS_ERROR1", Toast.LENGTH_SHORT).show()
            }
        ){
            override fun getParams(): MutableMap<String, String>? {
                val params = HashMap<String, String>()
                params["id_penginap"] = id_penginap.toString()
                params["id_penginapan"] = id_penginapan.toString()
                return params
            }
        }
        val queue: RequestQueue = Volley.newRequestQueue(this)
        queue.add(strReq)
    }

    fun toggleFavorit(id_penginap:Int,id_penginapan:Int){
        val strReq = object : StringRequest(
            Method.POST,"$WS_HOST/penginapan/toggle/favorit",
            Response.Listener {
                if (it.toString()!="\"\"") {
                    btnFavorit.imageTintList = resources.getColorStateList(R.color.red)
                }else{
                    btnFavorit.imageTintList = resources.getColorStateList(R.color.black)
                }
            },
            Response.ErrorListener {
                Toast.makeText(this, "WS_ERROR1", Toast.LENGTH_SHORT).show()
            }
        ){
            override fun getParams(): MutableMap<String, String>? {
                val params = HashMap<String, String>()
                params["id_penginap"] = id_penginap.toString()
                params["id_penginapan"] = id_penginapan.toString()
                return params
            }
        }
        val queue: RequestQueue = Volley.newRequestQueue(this)
        queue.add(strReq)
    }
    private fun loadMapScene(geoCoordinates:GeoCoordinates) {
        mapView.mapScene.loadScene(MapStyle.NORMAL_DAY
        ) { errorCode ->
            if (errorCode == null) {
                mapView.camera.target = GeoCoordinates(-7.286588157808639, 112.77709248650937)
                mapView.camera.zoomLevel = 15.0
            } else {
                Log.d(TAG, "onLoadScene failed: $errorCode")
            }
        }

        val mapImage = MapImageFactory.fromResource(this.resources, R.drawable.placeholder_resize)

        mapMarker = MapMarker(geoCoordinates)
        mapMarker.addImage(mapImage, MapMarkerImageStyle())

        mapView.mapScene.addMapMarker(mapMarker)
    }

    private fun initializeHERESDK() {
        // Set your credentials for the HERE SDK.
        val accessKeyID = "HvBSWvTW-ajXnBs6abqRLw"
        val accessKeySecret = "5pdus4zHhrkbdIggtB8K5svsGc7BMGc2GZpJuX4XSQQXF16CSCRGmeqoJmRnfSdYtyjRACVFHzchzABZEmnGTQ"
        val options = SDKOptions(accessKeyID, accessKeySecret)
        try {
            SDKNativeEngine.makeSharedInstance(this, options)
        } catch (e: InstantiationErrorException) {
            throw RuntimeException("Initialization of HERE SDK failed: " + e.error.name.toString())
        }
    }

    override fun onPause() {
        mapView.onPause()
        super.onPause()
    }

    override fun onResume() {
        mapView.onResume()
        super.onResume()
    }

    override fun onDestroy() {
        mapView.onDestroy()
        disposeHERESDK()
        super.onDestroy()
    }

    override fun onSaveInstanceState(outState: Bundle) {
        mapView.onSaveInstanceState()
        super.onSaveInstanceState(outState)
    }

    private fun disposeHERESDK() {
        // Free HERE SDK resources before the application shuts down.
        // Usually, this should be called only on application termination.
        // Afterwards, the HERE SDK is no longer usable unless it is initialized again.
        val sdkNativeEngine = SDKNativeEngine.getSharedInstance()
        if (sdkNativeEngine != null) {
            sdkNativeEngine.dispose()
            // For safety reasons, we explicitly set the shared instance to null to avoid situations,
            // where a disposed instance is accidentally reused.
            SDKNativeEngine.setSharedInstance(null)
        }
    }
}