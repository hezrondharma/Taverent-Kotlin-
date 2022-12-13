@extends('layout.layout')
@section('title','Laporan')
@section("extracss")
    <link rel="stylesheet" href="/css/admin.css">
@endsection
@section('navbar')

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
                <a href="/admin/listpenginapan">
                    <i class="fa fa-inbox fa-2x"></i>
                    <span class="nav-text">
                        List Penginapan
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

            <li class="has-subnav">
                <a href="/admin/laporan">
                    <i class="fa fa-bar-chart-o fa-2x"></i>
                    <span class="nav-text">
                        Laporan
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
    @if ($laporan !== null)
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Id Penginap</th>
            </tr>
            @foreach ($notifikasi as $notif)
                <tr>
                    <td>{{ $notif->id }}</td>
                    <td>{{ $notif->judul }}</td>
                    <td>{{ $notif->isi }}</td>
                    <td>{{ $notif->tipe }}</td>
                    <td>
                        <a href="{{ url("") }}" class="btn btn-primary">Ubah</a>
                        @if($pemiliks->trashed())
                        <a href="{{ url("") }}" class="btn btn-success">Recover</a>
                        @else
                        <a href="{{ url("") }}" class="btn btn-danger">Hapus</a>
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

