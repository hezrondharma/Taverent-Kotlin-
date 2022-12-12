@extends('layout.layout')
@section('title','List Pemilik')
@section("extracss")
    <link rel="stylesheet" href="/css/admin.css">
@endsection
@section('navbar')
<div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li class="has-subnav">
                <a href="/admin/listpenginap">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        List Penginap
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="/admin/listpemilik">
                    <i class="fa fa-key fa-2x"></i>
                    <span class="nav-text">
                        List Pemilik
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="/admin/laporan">
                    <i class="fa fa-bar-chart-o fa-2x"></i>
                    <span class="nav-text">
                        Laporan
                    </span>
                </a>

            </li>
            <li>
                <a href="/admin/listnotifikasi">
                    <i class="fa fa-bell fa-2x"></i>
                    <span class="nav-text">
                        List Notifikasi
                    </span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="/login">
                        <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </nav>

@endsection
@section('content')
<div class="area">
@if ($pemilik !== null)
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No Telephone</th>
            <th>Saldo</th>
            <th>Action</th>
        </tr>
        @foreach ($pemilik as $pemiliks)
            <tr>
                <td>{{ $pemiliks->id }}</td>
                <td>{{ $pemiliks->username }}</td>
                <td>{{ $pemiliks->password }}</td>
                <td>{{ $pemiliks->nama_lengkap }}</td>
                <td>{{ $pemiliks->email }}</td>
                <td>{{ $pemiliks->no_telp }}</td>
                <td>{{ $pemiliks->saldo }}</td>
                <td>
                    <a href="{{ url("admin/listpemilik/ubah/$pemiliks->id") }}" class="btn btn-primary">Ubah</a>
                    @if($pemiliks->trashed())
                    <a href="{{ url("admin/listpemilik/hapus/$pemiliks->id") }}" class="btn btn-success">Recover</a>
                    @else
                    <a href="{{ url("admin/listpemilik/hapus/$pemiliks->id") }}" class="btn btn-danger">Hapus</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@else
<h1>tidak ada daftar pemilik</h1>
@endif
</div>
@endsection

