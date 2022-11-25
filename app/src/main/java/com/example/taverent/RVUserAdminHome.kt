package com.example.taverent

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.ImageView
import android.widget.PopupMenu
import android.widget.TextView
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.RecyclerView

class RVUserAdminHome(
    private val songs: ArrayList<Penginap>,
    private val layout: Int,
    private val onMoreClickListener: (view: View, idx:Int)->Unit,
): RecyclerView.Adapter<RVUserAdminHome.CustomViewHolder>(){

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int,
    ): CustomViewHolder {
        var itemView = LayoutInflater.from(parent.context)
        return CustomViewHolder(itemView.inflate(
            layout, parent ,false
        ))
    }
    override fun onBindViewHolder(holder: CustomViewHolder, position: Int) {
        val item = songs[position]
        holder.textnama.text = item.nama_lengkap
        holder.imagebutton.setOnClickListener {
            onMoreClickListener?.invoke(it,position)
        }
    }


    override fun getItemCount(): Int {
        return songs.size
    }

    class CustomViewHolder(view: View): RecyclerView.ViewHolder(view) {
        val imageview: ImageView = itemView.findViewById(R.id.imageView4)
        val textnama: TextView = itemView.findViewById(R.id.textView14)
        val imagebutton: ImageButton = itemView.findViewById(R.id.imageButton3)

    }

}
