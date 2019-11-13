@extends('page.main.layouts.masterpage')
@section('title')
    Tour
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
    .orange{
    color: 	#F06757
    }
  </style>
@endsection
@section('content')
{{-- Bìa cover --}}
@include('page.main.layouts.cover')
{{-- Hết bìa cover --}}
<div class="site-section bg-light">
    <div class="container">
      @if(isset($tour))
      <div class="row">
        <div class="col-md-7 mb-5">
            <h1 class=" font-weight-light orange" style="color: #F58543;">WELCOME TO MY OWN TRIP! </h1>
            <p>Thông tin tour</p>
          
        </div>
        <div class="col-md-5">
          
          
          
          <div class="p-4 mb-3 bg-white">
            <img src="page_asset/images/hero_bg_1.jpg" alt="Image" class="img-fluid mb-4 rounded">
            <h3 class="h4 text-black mb-3" style="font-family: 'Times New Roman', Times, serif;">{{ $tour->name }}</h3>
            <div style="text-align:center">
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
                    <a style="font-family: 'Times New Roman', Times, serif">({{ $tour->rate_size }})</a>
                  </div>
            <p>{{ $tour->description }}</p>
            <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Host by {{ $tour->user->first_name.' '.$tour->user->last_name }}</a></p>
          </div>
          <form action="#" class="p-5 bg-white">
            <div class="row form-group">
                <div class="col-md-12">
                        <label class="text-black" for="size">People size</label> 
                        <input type="number" name="size" class="form-control" placeholder="Số người dự kiến"
                        value="1" data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="date_from">From</label> 
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_from" class="form-control" 
                    data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="date_to">To</label> 
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_to" class="form-control"
                    data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="note">Notes</label> 
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
            </div>
    
            <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" value="BOOK THIS" class="btn btn-primary py-2 px-4 text-white">
                </div>
            </div>
          </form>
        </div>
      </div>
      @endif
    </div>
</div>

@endsection