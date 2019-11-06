@extends('page.main.layouts.masterpage')
@section('title')
    All tours
@endsection

@section('content')
{{-- Bìa cover --}}
@include('page.main.layouts.cover')
{{-- Hết bìa cover --}}

<div class="site-section">
      
    <div class="container">
      
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
          <a href="#" class="unit-1 text-center">
            <img src="page_asset/images/01-greece.jpg" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <strong class="text-primary mb-2 d-block">$590</strong>
              <h3 class="unit-1-heading">Santorini, Greece</h3>
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
      </div>
    </div>
  
  </div>
  {{-- intro  --}}
  @include('page.main.layouts.intro')
  {{-- hết intro --}}
@endsection