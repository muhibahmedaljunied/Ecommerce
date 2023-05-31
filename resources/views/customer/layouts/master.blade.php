<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/bootstrap.css')}}" />

  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/linericon/style.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/themify-icons.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/flaticon.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/owl-carousel/owl.carousel.min.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/lightbox/simpleLightbox.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/nice-select/css/nice-select.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/animate-css/animate.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/jquery-ui/jquery-ui.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/vendors/jquery-ui/jquery-ui.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/style.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('assets/front-end/css/responsive.css')}}" />


  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style type="text/css">
    .badge-notify {
      background: #4CD964;
      position: relative;
      top: -15px;
      left: -7px;
    }
  </style>
</head>

<body>

  <div id="app">
    <!--================Header Menu Area =================-->
    <header-section-customer></header-section-customer>
    <!--================Header Menu Area =================-->
    <router-view></router-view>
    <!--================ start footer Area  =================-->
    <footer-section-customer></footer-section-customer>
    <!-- <vue-progress-bar></vue-progress-bar> -->
    <!--================ End footer Area  =================-->
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://www.paypal.com/sdk/js?client-id=<?php echo env('PAYPAL_SANDBOX_CLIENT_ID') ?>&currency=USD"></script> -->

  <script src="{{asset('assets/front-end/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('assets/front-end/js/popper.js')}}"></script>
  <script src="{{asset('assets/front-end/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/front-end/js/stellar.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/lightbox/simpleLightbox.min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/isotope/isotope-min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/front-end/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/counter-up/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets/front-end/vendors/counter-up/jquery.counterup.js')}}"></script>
  <script src="{{asset('assets/front-end/js/mail-script.js')}}"></script>
  <script src="{{asset('assets/front-end/js/theme.js')}}"></script>
  <script src="{{ asset('js/app.js') }}"></script>


  <!-- stripe payment method -->
  <!-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> -->


</body>

</html>