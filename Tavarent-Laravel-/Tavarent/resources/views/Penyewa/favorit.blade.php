@extends('layout.layout')
@section('title','Penyewa')
@section('navbar')
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="/penyewa">Cari</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/penyewa/favorit">Favorit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/penyewa/kossaya">Kos Saya</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/penyewa/chat">Chat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/penyewa/profil">Profil</a>
    </li>
</ul>
@endsection
