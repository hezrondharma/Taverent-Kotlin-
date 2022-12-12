@extends('layout.layout')
@section('title','Penginap')
@section("extracss")
    <link rel="stylesheet" href="{{asset('/css/penginap.css')}}">
    <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css"
    href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
@endsection
@section("extrajs")
    <script src="{{asset('/java/penginap.js')}}"></script>
    <script src="{{asset('/java/jquery-ui.js')}}"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
     type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
    type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"
    type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"
    type="text/javascript" charset="utf-8"></script>
@endsection
@section('navbar')
    @include("navbar.navbarpenginap")
@endsection
@section('content')
    <div class="container" style="margin-top:100px;">
        <input type="hidden" name="" val="" id="address">
        <input type="hidden" name="" val="" id="koordinat">
        <div class="left" style="width:50%;float:left;">
            <div style="width:100%;margin-bottom:30px;height:auto;overflow:hidden;">
                <input type="text" name="" id="searchtextinput" class="form-control" style="width:80%; float:left;" placeholder="Search penginapan terdekat">
                <input type="button" value="Search" id="search" class="btn btn-warning" style="width:18%;margin-left:2%;float:left;">
            </div>
            @forelse($penginapan as $p)
            <a href="" style="color:black;">
            <div class="kotak" style="border:1px solid gray; border-radius:10px;margin-top:10px;margin-bottom:10px;height:auto;overflow:hidden;padding:20px;position:relative;">
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
                    <div style="position:absolute;right:20px;top:20px;font-weight:bold;">{{$p->tipe}}</div>
                    <div style="position:absolute;right:20px;bottom:20px;border:2px solid lightblue;border-radius:5px;padding:2px;font-size:10pt;">{{$p->jk_boleh}}</div>
                    <div class="product-price">Rp. {{$p->harga}}</div>
                </div>
            </div>
            </a>
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
            
            var platform;
            var map;
            var marker;
            function getLocation(position){
                platform = new H.service.Platform({
                    'apikey': 'rQWmEReEoxYDzqrD4qDxp08gW5ZGMBv_0zXDW547jRg'
                });
                var defaultLayers = platform.createDefaultLayers();
                map = new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                        zoom: 14,
                        center: { lat: position.coords.latitude, lng: position.coords.longitude }
                    }
                );
                var mapevents = new H.mapevents.MapEvents(map)
                var ui = H.ui.UI.createDefault(map, defaultLayers);
                ui.getControl('mapsettings').setDisabled(true)
                map.addEventListener('tap', function(evt) {
                    // Log 'tap' and 'mouse' events:
                    console.log(evt.type, evt.currentPointer.type); 
                });
                var behavior = new H.mapevents.Behavior(mapevents);

                
                marker = new H.map.Marker({ lat: position.coords.latitude, lng: position.coords.longitude });
                // Add the marker to the map and center the map at the location of the marker:
                map.addObject(marker);
                map.setCenter({ lat: position.coords.latitude, lng: position.coords.longitude });
            }
            $('#search').click(function(){
                navigator.geolocation.getCurrentPosition(getAddress);
            });
            function getAddress(position){
                var autocomplete = [];
                var location = [];

                var platform = new H.service.Platform({
                    'apikey': 'rQWmEReEoxYDzqrD4qDxp08gW5ZGMBv_0zXDW547jRg'
                });
                var service = platform.getSearchService();

                service.autosuggest({
                // Search query
                    q: String($('#searchtextinput').val()),
                    at: position.coords.latitude+','+position.coords.longitude,
                }, (result) => {

                    var idx = 1;
                    result.items.forEach((item)=>{
                        autocomplete.push({label:item.title,idx:idx});
                        location.push({koordinat:item.position,idx:idx})
                        idx++;
                    });
                });
                console.log(autocomplete.toString());
                $("#searchtextinput").autocomplete({
                    source: autocomplete,
                    minLenght: 0,
                    autoFocus: true,
                    select: function(event,ui){
                        $('#address').val(autocomplete[ui.item.idx].label);
                        $('#koordinat').val(location[ui.item.idx].koordinat.lat+','+location[ui.item.idx].koordinat.lng);
                        map.setCenter(location[ui.item.idx].koordinat);
                        map.removeObject(marker);
                        marker = new H.map.Marker(location[ui.item.idx].koordinat);
                        map.addObject(marker);
                    }
                }).focus(function () {
                    $(this).autocomplete("search");
                });

            }
            
            
        });
             
                        
    </script>
    
@endsection