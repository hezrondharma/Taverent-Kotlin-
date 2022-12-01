@extends('layout.loginregister')
@section('title','Register')

@section('content')
<form action="#" method="POST" class="signin-form">
    @csrf
    <div class="form-group mb-3">
        <label class="label" for="name">Nama</label>
        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama">
        {{-- @error("email")
            <label class="label text-danger" for="email">{{$message}}</label>
        @enderror --}}
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Email</label>
        <input type="text" class="form-control" placeholder="Masukkan Email" name="email">
        {{-- @error("email")
            <label class="label text-danger" for="email">{{$message}}</label>
        @enderror --}}
    </div>
    <div class="form-group mb-4">
        <label class="label" for="password">Password</label>
        <input id="password" type="password" class="form-control" placeholder="Masukkan Password" name="password">
        {{-- @error("password")
            <label class="label text-danger" for="password">{{$message}}</label>
        @enderror --}}
    </div>

    <div class="form-group mb-3">
        <button type="submit" class="button form-control rounded px-3">Register</button>
    </div>
</form>
<p class="text-center">OR<br><a href="{{url('/login')}}">Go To Login Page</a></p>

@endsection
