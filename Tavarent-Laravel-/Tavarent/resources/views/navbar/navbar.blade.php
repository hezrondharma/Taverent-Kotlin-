<div class="sticky-top">
    <nav class="navbar navbar-expand-lg" style="background-color:#D9D9D9;outline-style: solid;">
        <a class="navbar-brand" href="#">
            <img src="{{asset('img/logo.png')}}" alt="" width="75"  height="auto">
        </a>
        <div class="d-flex" id="navbarSupportedContent">
            @yield('navbar')
        </div>
        <div class="d-flex justify-content-center">
            <label class="ms-4 mr-3" for="">Welcome,</label>
            <label class="mr-3" for="">Saldo : </label>
        </div>
        <div class="d-flex justify-content-end">
            <form action="/customer/logout">
                <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>



    </nav>
</div>
