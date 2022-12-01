@extends('layout.layout')
@section('title','Pemilik')
@section('navbar')
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="/pemilik">Home</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/pemilik/chat">Chat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pemilik/kelola">Kelola</a>
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
<form class="mt-5 d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Cari Kos Disini " aria-label="Search">
    <img src="{{asset('img/search.png')}}" alt="" width="50" height="auto" type="submit">
</form>

@endsection

