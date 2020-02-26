<!DOCTYPE html>
<html lang="en">

<head>
<title>LOCALIF3 - @yield('title')</title>
  <base href="{{asset('')}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- ----------------- --}}

 {{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> --}}
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700">
  <link rel="stylesheet" href="page_asset/fonts/icomoon/style.css">
  <link rel="stylesheet" href="page_asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="page_asset/css/magnific-popup.css">
  <link rel="stylesheet" href="page_asset/css/jquery-ui.css">
  <link rel="stylesheet" href="page_asset/css/owl.carousel.min.css">
  <link rel="stylesheet" href="page_asset/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="page_asset/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="page_asset/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
  <link rel="stylesheet" href="page_asset/css/aos.css">
  <link rel="stylesheet" href="page_asset/css/style.css">
  <link rel="stylesheet" href="page_asset/css/custom.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
  {{-- ----------- --}}
  
  

  <!-- Custom Stylesheets -->

  <style>
    .user-area {
        float: right;
        padding-right: 0;
        position: relative;
        padding-left: 20px;
    }
    .dropdown .dropdown-toggle {
        line-height: 55px;
        
    }
    .user-area .dropdown-toggle {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .user-area .dropdown-toggle {
        position: relative;
        z-index: 0;
    }
    .user-area .user-menu {
        background: #fff;
        border: none;
        left: inherit !important;
        right: 0;
        top: 40px !important;
        margin: 0;
        max-width: 150px;
        padding: 5px 10px;
        position: absolute;
        width: 100%;
        z-index: 999;
        -webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.7);
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.7);
    }
    .user-area .user-avatar {
        float: right;
        width: 30px;
        border: 2px solid #849896;
        position: relative;
        left: -27px;
        top: 18px;
        position: relative;
        transition: none 0s ease 0s;
        cursor: move;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .user-options{
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        padding: 0px;
        display: block;
        margin-left: -5px;
        color: #58595b;
    }
    
  </style>
  @yield('css')
  
</head>

<body>
  @include('page.layouts.top_bar')
  {{-- <div class="site-wrap"> --}}
    
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    
    {{-- Menu chính --}}
      @include('page.layouts.menu')
    {{-- Hết menu chính --}}

    {{-- Bìa cover --}}
    {{-- @include('page.layouts.cover') --}}
    {{-- Hết bìa cover --}}

    {{-- Location --}}
    {{-- @include('page.layouts.location') --}}
    {{-- Hết location --}}

    {{-- intro --}}
    {{-- @include('page.layouts.intro') --}}
    {{-- hết intro --}}
    

    {{-- mission --}}
    {{-- @include('page.layouts.mission') --}}
    {{-- hết mission --}}
 


    {{-- <div class="site-section">  --}}
      {{-- content --}}
      @yield('content')
     {{-- hết content --}}





      {{-- footer --}}
      @include('page.layouts.footer')
      {{-- Hết footer --}}

      <script src="page_asset/js/jquery-3.3.1.min.js"></script>
      <script src="page_asset/js/jquery-migrate-3.0.1.min.js"></script>
      <script src="page_asset/js/jquery-ui.js"></script>
      <script src="page_asset/js/popper.min.js"></script>
      <script src="page_asset/js/bootstrap.min.js"></script>
      <script src="page_asset/js/owl.carousel.min.js"></script>
      <script src="page_asset/js/jquery.stellar.min.js"></script>
      <script src="page_asset/js/jquery.countdown.min.js"></script>
      <script src="page_asset/js/jquery.magnific-popup.min.js"></script>
      <script src="page_asset/js/bootstrap-datepicker.min.js"></script>
      <script src="page_asset/js/aos.js"></script>

      <script src="page_asset/js/main.js"></script>
      @yield('script')
</body>

</html>