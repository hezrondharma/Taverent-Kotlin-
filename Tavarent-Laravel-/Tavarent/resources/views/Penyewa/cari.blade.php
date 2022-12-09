@extends('layout.layout')
@section('title','Penginap')
@section("extracss")
    <link rel="stylesheet" href="/css/penginap.css">
@endsection
@section("extrajs")
    <script src="/java/penginap.js"></script>
@endsection
@section('navbar')
    @include("navbar.navbarpenginap")
@endsection
@section('content')
<div class="container" style="margin-top:150px; height:1000px;">
    
    <div style="margin-left:2%">
        <h4>Search Penginapan Terdekat</h4>
        <a href="/penyewa/search" style="text-decoration:none;">
            <input type="text" name="" id="" class="form-control" style="width:60%;" placeholder="Search penginapan terdekat">
        </a>
    </div>
    
    <div class="container" style="justify-content:space-between;">
        @forelse($penginapan as $p)
        <div class="product-card">
            <div class="badge">{{$p->tipe}}</div>
            <div class="product-tumb">
                <img src="https://i.imgur.com/xdbHo4E.png" alt="">
            </div>
            <div class="product-details">
                <span class="product-catagory">{{$p->jk_boleh}}</span>
                <h4><a href="">{{$p->nama}}</a></h4>
                <p>
                    @php
                        if (strlen($p->deskripsi)>100){
                            echo substr($p->deskripsi,0,80) . " ... ";
                        }else{
                            echo $p->deskripsi;
                        }
                    @endphp
                </p>
                <div class="product-bottom-details">
                    <div class="product-price">Rp. {{$p->harga}}</div>
                    <div class="product-links">
                    </div>
                </div>
            </div>
        </div>
        @empty
            <h2>Tidak ada penginapan</h2>
        @endforelse
    </div>
</div>

@endsection

