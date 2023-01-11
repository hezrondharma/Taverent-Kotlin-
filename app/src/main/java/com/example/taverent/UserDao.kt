package com.example.taverent

import androidx.room.*
/*
DAO ini interface yang jadi perantara kotlin dengan database.
Isinya method2 yang digunakan untuk melakukan query ke database
Untuk command basic kyk insert, update, dan delete bisa pake annotation
@Insert, @Update, dan @Delete dengan objek yang mau diinsert/update/delete yang dipassing sebagai
parameternya.

Kalo query2 yang bersifat lebih spesifik, bisa pakai @Query dengan isi querynya sebagai
parameter functionnya
 */
@Dao
interface UserDao {
    @Insert
    suspend fun insert(user:UserEntity)

    @Insert
    suspend fun insert(Guest:PenginapanEntity)

    @Insert
    suspend fun insert(Chat:ChatEntity)

    @Delete
    suspend fun delete(user:UserEntity)

    @Query("DELETE FROM users")
    suspend fun deleteUserTable()

    @Query("DELETE FROM penginapans")
    suspend fun deleteLGuestTable()

    @Query("DELETE FROM chats")
    suspend fun deleteChatTable()

    @Query("SELECT * FROM users")
    suspend fun fetch():List<UserEntity>

    @Query("SELECT * FROM penginapans")
    suspend fun fetchLGuest():List<PenginapanEntity>

    @Query("SELECT * FROM chats")
    suspend fun fetchChat():List<ChatEntity>

    @Query("SELECT * FROM users where username = :username")
    suspend fun unique(username:String):UserEntity?
}