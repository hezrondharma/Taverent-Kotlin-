@extends('layout.layout')
@section('title','Pemilik')
@section('navbar')
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="/pemilik">Home</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pemilik/chat">Chat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/pemilik/kelola">Kelola</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pemilik/statistik">Statistik</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pemilik/profil">Profil</a>
    </li>
</ul>
@endsection
@section('content')
<form action="" method="POST" class="signin-form" >
    @csrf
    <input type="hidden" id="hidden" name="hidden" value="login">
    <div class="form-group mb-3">
        <label class="label" for="name">Nama Properti</label>
        <input type="text" class="form-control" placeholder="Nama Properti" value="{{ old('nproperti') }}" name="nproperti">
        @error("nproperti")
            <label class="label text-danger" for="nproperti">{{$message}}</label>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Deskripsi Tambahan</label>
        <input type="text" value="{{ old('deskripsi') }}" class="form-control" placeholder="Deskripsi Tambahan" name="deskripsi">
        @error("deskripsi")
            <label class="label text-danger" for="deskripsi">{{$message}}</label>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Harga Perbulan</label>
        <input type="text" value="{{ old('harga') }}" class="form-control" placeholder="Harga Perbulan" name="harga">
        @error("harga")
            <label class="label text-danger" for="harga">{{$message}}</label>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Jenis Kelamin yang diperbolehkan</label>
        <select name="selector">
            <option value="campur">Campur</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select>
        @error("jkelamin")
            <label class="label text-danger" for="jkelamin">{{$message}}</label>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Alamat</label>
        <input type="text" value="{{ old('alamat') }}" class="form-control" placeholder="Masukkan Alamat" name="alamat">
        @error("alamat")
            <label class="label text-danger" for="alamat">{{$message}}</label>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Fasilitas Minimal 3</label>
        <div>
            <input type="checkbox" name="ac" value="yes">
            <label >Air Conditioner</label>
            <input type="checkbox" name="termasuklistrik" value="yes">
            <label >Termasuk Listrik</label>
            <input type="checkbox" name="kdalam" value="yes">
            <label >K. Mandi Dalam</label>
            <br>
            <input type="checkbox" name="kursi" value="yes">
            <label >Kursi</label>
            <input type="checkbox" name="meja" value="yes">
            <label >Meja</label>
            <input type="checkbox" name="wifi" value="yes">
            <label >Wifi</label>
            <br>
            <input type="checkbox" name="kasurdouble"  value="yes">
            <label >Kasur Double</label>
            <input type="checkbox" name="tv" value="yes">
            <label >Tv</label>
            <input type="checkbox" name="kasursingle" value="yes">
            <label >Kasur Single</label>
            <br>
            <input type="checkbox" name="jendela"  value="yes">
            <label >Jendela</label>
            <input type="checkbox" name="airpanas" value="yes">
            <label >Air Panas</label>
            <input type="checkbox" name="dapur" value="yes">
            <label >Dapur</label>

    </div> <br>
    <label class="label" for="name">Jenis Penginapan</label>
    <div class="form-group mb-4">
        <label class="label" for="name">Apartemen</label> <input type="radio" name="rbJenis" value="Apartemen"><i class="validation"></i>
        <label class="label" for="name">Kos</label>  <input type="radio" name="rbJenis" value="Kos"><i class="validation"></i><br>
        @error("rbJenis")
            <label class="label text-danger" for="rbJenis">{{$message}}</label>
        @enderror
    </div>
        <button type="submit" class="button form-control rounded px-3" >Daftar</button>
    </div>
</form>

@endsection

