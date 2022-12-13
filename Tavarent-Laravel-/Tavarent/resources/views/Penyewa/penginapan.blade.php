@extends("layout.layout")
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
<div class="container">
    <div class="jumbotron">
        <div class="carousel">
            
        </div>
        <div id="mapContainer">

        </div>
    </div>
    <div class="body">
        
    </div>
</div>
    <script>
        function start(){
            var platform = new H.service.Platform({
                    'apikey': 'rQWmEReEoxYDzqrD4qDxp08gW5ZGMBv_0zXDW547jRg'
            });
            var defaultLayers = platform.createDefaultLayers();
            var map = new H.Map(
                document.getElementById('mapContainer'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 14,
                    center: { lat: $('#lat').attr("val"), lng: $('#lng').attr("val") }
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

            
            marker = new H.map.Marker({ lat: $('#lat').attr("val"), lng: $('#lng').attr("val") });
        }
    </script>
@endsection