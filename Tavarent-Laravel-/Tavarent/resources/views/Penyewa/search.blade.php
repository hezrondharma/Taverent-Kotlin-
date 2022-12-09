@extends('layout.layout')
@section('title','Penginap')
@section("extracss")
    <link rel="stylesheet" href="{{asset('/css/penginap.css')}}">
@endsection
@section("extrajs")
    <script src="{{asset('/java/penginap.js')}}"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
     type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
    type="text/javascript" charset="utf-8"></script>
@endsection
@section('navbar')
    @include("navbar.navbarpenginap")
@endsection
@section('content')
    <div class="container" style="margin-top:100px;">
        <div class="left" style="width:50%;float:left;">
            <a href="" style="text-decoration:none;">
                <input type="text" name="" id="" class="form-control" style="width:100%;" placeholder="Search penginapan terdekat">
            </a>
            @forelse($penginapan as $p)
            <div class="kotak" style="border:1px solid gray; border-radius:10px;margin-top:10px;margin-bottom:10px;height:auto;overflow:hidden;padding:20px;">
                <img src="" alt="gambar penginapan" style="float:left;object-fit:cover;background-color:gray;" width="160px" height="160px">
                <div class="right" style="width:calc(95% - 160px);float:left;margin-left:5%;">
                    <h4 style="font-size:15pt;margin-bottom:0px;">{{$p->nama}}</h4>
                    <p style="font-size:10pt;">{{$p->alamat}}</p>
                    <p  style="font-size:10pt;">
                        @php
                            if (strlen($p->deskripsi)>100){
                                echo substr($p->deskripsi,0,100) . " ... ";
                            }else{
                                echo $p->deskripsi;
                            }
                        @endphp
                    </p>
                    <div class="product-price">Rp. {{$p->price}}</div>
                </div>
            </div>
            @empty
            <h4>Tidak ada penginapan di dekat anda</h4>
            @endforelse
        </div>
        <div class="right" style="width:50%;float:left;padding-left:5%;">
            <div style="position:fixed;top:20%;left:55%;width: 40%; height: 70%;border-radius:10px;border:1px solid gray; overflow:hidden" id="mapContainer"></div>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getLocation);
            } else { 
                alert("iowejfiojw");
            }

            function getLocation(position){
                alert(position.coords.latitude+","+ position.coords.longitude );
                var platform = new H.service.Platform({
                    'apikey': 'rQWmEReEoxYDzqrD4qDxp08gW5ZGMBv_0zXDW547jRg'
                });
                var defaultLayers = platform.createDefaultLayers();
                var map = new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                        zoom: 15,
                        center: { lat: position.coords.latitude, lng: position.coords.longitude }
                    }
                );
            }
        });
             
                        
    </script>
    
@endsection