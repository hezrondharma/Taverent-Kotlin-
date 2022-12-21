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
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-CAcpC230ptHYx8Z1"></script>
@endsection
@section('navbar')
    @include("navbar.navbarpenginap")
@endsection
@section('content')

    @php
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = 'SB-Mid-server-NMVGX2Rc1aiDP37T7ABu93tq';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    
    $params = array(
        'transaction_details' => array(
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        ),
        'customer_details' => array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
        ),
    );
    
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo "<script type='text/javascript'>
      function start(){
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('$snapToken', {
          onSuccess: function(result){
            /* You may add your own implementation here */
          },
          onPending: function(result){
            /* You may add your own implementation here */
          },
          onError: function(result){
            /* You may add your own implementation here */
          },
          onClose: function(){
            /* You may add your own implementation here */
          }
        })
      });
    }
    </script>";
    @endphp
    <br><br><br><br><br><br><br>
    <button id="pay-button">Pay!</button>
    
 
    
    @php
      echo $java;
    @endphp
@endsection