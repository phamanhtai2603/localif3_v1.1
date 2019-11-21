@extends('page.main.layouts.masterpage')
@section('title')
    All tours
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
@include('page.main.layouts.cover')
@include('page.main.layouts.location')
{{-- Hết bìa cover --}}

<div class="site-section">
    <div class="container ">
      <div class="row">
          @foreach($tours as $tour)     
          <?php 
             $arr_image = explode ( ',' , $tour->image,-1);
          ?>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <a href="{{ route('get-page-tourdetail-view',['id'=>$tour->id]) }}" class="unit-1 text-center">
              <img src="images/{{ $arr_image[1] }}" style="width:350px;height:400px;" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading t-name" style="padding: 5px; margin:0px">{{ $tour->name }}</h3>
                <strong class="text-primary mb-2 d-block t-price" style="margin:0px">{{ $tour->price }} VND</strong>
                <p style="padding: 5px; font-size:15px ; margin:0px " class="color-white-opacity-5">{{ $tour->location->name }} </p>
                <div>
                  @if($tour->avgrate==NULL)
                  <span style="color:yellow">No rate</span>
                  @elseif($tour->avgrate<=3)
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  @elseif($tour->avgrate==4)
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  @elseif($tour->avgrate==5)
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
      </div>
    </div>
    <div class="container">
      <div class="pagination">
        <div style="margin: auto;">
         {!! $tours->links() !!}
        </div>
      </div>
  </div>
  
  </div>
  {{-- intro  --}}
  @include('page.main.layouts.intro')
  {{-- hết intro --}}
@endsection