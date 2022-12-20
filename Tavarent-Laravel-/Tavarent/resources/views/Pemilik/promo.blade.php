@extends('layout.layout')
@section('title','Pemilik')
@section("extracss")
    <link rel="stylesheet" href="/css/penginap.css">
@endsection
@section("extrajs")
    <script src="/java/penginap.js"></script>
@endsection
@section('navbar')
    @include("navbar.navbarpemilik")
@endsection
@section('content')
    <div class="container" style="overflow:hidden;height:auto;padding-bottom:100px;padding-top:80px;">
        <div class="left" style="float:left;width:30%;height:100%">
            <p class="hint">Judul Promo</p>
            <input type="text" name="nama" id="">
        </div>
        <div class="right" style="float:left;width:70%;height:100%">
            <table class="table">

            </table>
        </div>
    </div>
@endsection