@extends('page.layouts.masterpage')
@section('title')
    Homepage
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .t-price{
      margin: 0px;
      position: relative;
      top: 16px;
    }
    .t-name{
      padding: 5px;
      margin: 0px;
      transition: none 0s ease 0s;
      cursor: move;
      position: relative;
      top: 17px;
    }
    .checked{
    color: orange;
    }
  </style>
@endsection

@section('content')


    {{-- Bìa cover --}}
    @include('page.layouts.cover')
    {{-- Hết bìa cover --}}

    {{-- Location --}}
    @include('page.layouts.location')
    {{-- Hết location --}}

    {{-- intro  --}}
    @include('page.layouts.intro')
    {{-- hết intro --}}
 
    {{-- mission --}}
     @include('page.layouts.mission')
    {{-- hết mission --}}


    {{-- <div class="site-section"> --}}
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <h2 class="font-weight-light text-black">Choose your favourite local</h2>
      </div>
    </div>
    <div class="row">
      @foreach($tours as $tour)     
        <?php 
           $arr_image = explode("," , $tour->image);
        ?>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
          <a href="{{ route('get-page-tourdetail-view',['id'=>$tour->id]) }}" class="unit-1 text-center">
            @if($tour->image != NULL )
              <img src="images/{{ $arr_image[0] }}" style="width:350px;height:400px;" alt="Image" class="img-fluid">
            @else
              <img src="images/default_cover.jpg" style="width:350px;height:400px;" alt="Image" class="img-fluid">
            @endif
            <div class="unit-1-text">
              <h3 class="unit-1-heading t-name" style="padding: 5px; margin:0px">{{ $tour->name }}</h3>
              <strong class="text-primary mb-2 d-block t-price" style="margin:0px">{{ $tour->price }} VND</strong>
              <p style="padding: 5px; font-size:15px ; margin:0px " class="color-white-opacity-5">{{ $tour->location->name }} </p>
              <div>
                @if($tour->avgrate==NULL)
                <span style="color:yellow">No rate</span>
                @elseif($tour->avgrate<=3.5)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                @elseif($tour->avgrate>3.5 && $tour->avgrate<=4.5)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                @elseif($tour->avgrate>4.5 && $tour->avgrate<=5 )
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                @endif
              </div>
            </div>
          </a>
        </div>
      @endforeach

      <div style="margin:auto; font-size: 30px; ">
        <a href="{{ route('get-page-alltours-view') }}">View all</a>
      </div>
    </div>
  </div>
  
  <br />
      {{-- intro team --}}
      @include('page.layouts.team_intro')
      {{-- hết intro team --}}
@endsection