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
<div class="container" style="height:1000px;"></div>

@endsection

