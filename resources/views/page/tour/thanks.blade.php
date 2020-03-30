@extends('page.layouts.masterpage')
@section('title')
    Thanks you!
@endsection
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600">
  <style>
    #slider {
  position: relative;
  overflow: hidden;
  margin: 20px auto 0 auto;
  border-radius: 4px;
  }

  #slider ul {
    position: relative;
    margin: 0;
    padding: 0;
    height: 200px;
    list-style: none;
  }

  #slider ul li {
    position: relative;
    display: block;
    float: left;
    margin: 0;
    padding: 0;
    width: 500px;
    height: 300px;
    background: #ccc;
    text-align: center;
    line-height: 300px;
  }

  a.control_prev, a.control_next {
    position: absolute;
    top: 40%;
    z-index: 999;
    display: block;
    padding: 4% 3%;
    width: auto;
    height: auto;
    background: #2a2a2a;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    font-size: 18px;
    opacity: 0.8;
    cursor: pointer;
  }

  a.control_prev:hover, a.control_next:hover {
    opacity: 1;
    -webkit-transition: all 0.2s ease;
  }

  a.control_prev {
    border-radius: 0 2px 2px 0;
  }

  a.control_next {
    right: 0;
    border-radius: 2px 0 0 2px;
  }

  .slider_option {
    position: relative;
    margin: 10px auto;
    width: 160px;
    font-size: 18px;
  }

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
    .orange{
    color: 	#F06757
    }
  </style>
@endsection
@section('content')
{{-- Bìa cover --}}
@include('page.layouts.cover')
{{-- Hết bìa cover --}}
<div class="site-section bg-light">
        <div class="container">
          <div class="row" >
              <div class="col-md-12" >
                <h1 style=" color: #F58543;">THANK YOU FOR USING OUR SERVICE!</h1>
              </div>  
              <div class="col-md-12" style="font-family: 'Times New Roman'; font-size: 20px">
                  <p>You have booked a tour: {{ $name }} </p>
                  <p>By host: <a href="{{ route('get-page-otheruser-profile-view',['id'=>$tourguide->id]) }}">{{ $tourguide->first_name.' '.$tourguide->last_name }}</a> - Hotline of host: {{ $tourguide_phone }}</p>
                  <p>For {{ $size }} people</p>
                  <p>On day:  {{ substr($date, 0, -1) }}</p>
                  <p>TOTAL COST: <b><i>{{ number_format($total_price)  }} VND</i></b></p>
                  <p style=" color: #F58543;"> This order didnt checked. Please waiting for the host's response! </p>
              </div>
            </div>
        </div>
    </div>
@endsection