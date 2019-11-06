@extends('page.main.layouts.masterpage')
@section('title')
    Homepage
@endsection
@section('content')
   

    {{-- Bìa cover --}}
    @include('page.main.layouts.cover')
    {{-- Hết bìa cover --}}

    {{-- Location --}}
    @include('page.main.layouts.location')
    {{-- Hết location --}}

    {{-- intro  --}}
    @include('page.main.layouts.intro')
    {{-- hết intro --}}
 
    {{-- mission --}}
     @include('page.main.layouts.mission')
    {{-- hết mission --}}


    <div class="site-section">
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <h2 class="font-weight-light text-black">Choose your favourite local</h2>
        <p class="color-black-opacity-5">View all</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/01-greece.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$590</strong>
            <h3 class="unit-1-heading">Santorini, Greece</h3>
            <p style="padding: 5px" class="color-white-opacity-5">Mô tả ở đây! Mô tả ở đây! Mô tả ở đây! Mô
              tả ở đây! Mô tả ở đây! Mô tả ở đây! Mô tả ở đây! Mô tả ở đây! Mô tả ở đây! Mô tả ở đây!
              Mô tả ở đây! Mô tả ở đây! Mô tả ở đây! </p>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/02-rome.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$390</strong>
            <h3 class="unit-1-heading">Rome, Italy</h3>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/03-japan.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$390</strong>
            <h3 class="unit-1-heading">Mount Fuji, Japan</h3>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/04-dubai.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$320</strong>
            <h3 class="unit-1-heading">Camels, Dubai</h3>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/05-london.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$290</strong>
            <h3 class="unit-1-heading">Elizabeth Tower, London</h3>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
        <a href="#" class="unit-1 text-center">
          <img src="page_asset/images/06-australia.jpg" alt="Image" class="img-fluid">
          <div class="unit-1-text">
            <strong class="text-primary mb-2 d-block">$390</strong>
            <h3 class="unit-1-heading">Opera House, Australia</h3>
          </div>
        </a>
      </div>
      <div style="margin:auto; font-size: 30px; ">
        <a href="about.html">View all</a>
      </div>
    </div>
  </div>
  
  <br />
      {{-- intro team --}}
      @include('page.main.layouts.team_intro')
      {{-- hết intro team --}}
@endsection