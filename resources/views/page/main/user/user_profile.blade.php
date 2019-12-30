@extends('page.main.layouts.masterpage')
@section('title')
    Profile
@endsection
@section('css')
<link rel="stylesheet" href="page_asset/css/style.css">
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
{{-- Hết bìa cover --}}

<div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-7 mb-5">

            <div class="row form-group" >
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">First Name</label>
                <input type="text" id="first_name" value="{{ $user->first_name }}"class="form-control" readonly>
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Last Name</label>
                <input type="text" id="last_name" value="{{ $user->last_name }}" class="form-control" readonly>
              </div>
            </div>

            <div class="row form-group">
              
              <div class="col-md-12">
                <label class="text-black" for="email">Phone</label> 
                <input type="number" id="email" name ="phone_number" value="{{ $user->phone_number }}" class="form-control" readonly>
              </div>
            </div>
            <div class="row form-group">
              
              <div class="col-md-12">
                <label class="text-black" for="subject">Date of birth</label> 
                <input id="date_of_birth" name="date_of_birth" type="date" value="{{substr($user->date_of_birth,0,-9)}}" placeholder="Ngày sinh" class="form-control" readonly>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="address">Address</label> 
                <input name="address" value="{{ $user->address}}" id="address" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..." readonly>
              </div>
            </div>

            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="address">Gender</label> 
                    <input name="address" 
                    @if($user->gender==1)
                    value="Male" 
                    @elseif($user->gender==0)
                    value="Female"
                    @endif
                    id="address" cols="30" rows="7" class="form-control" readonly>
                </div>
            </div>     
        </div>

        <div class="col-md-5">
          
          <div class="p-4 mb-3 bg-white">
 
            <p class="mb-0 font-weight-bold">Email Address</p>
            <p class="mb-0"><a href="#">{{  $user->email }}</a></p>

            <p class="mb-0 font-weight-bold">User type</p>
            @if( $user->role==1)
            <p class="mb-0"><a href="#">Admin</a></p>
            @elseif( $user->role==2)
            <p class="mb-0"><a href="#">Tourist Guide</a></p>
            @elseif( $user->role==3)
            <p class="mb-0"><a href="#">Normal</a></p>
            @endif

          </div>
          
          <div class="p-4 mb-3 bg-white">
            <div class="col-sm-6 col-md-4 user-img">
                                                <img id="preview_avatar" width="222px" src="
                            @if ( $user->avatar == null)
                                {{'upload/images/default.png'}}
                            @else
                            {{'upload/images/' .  $user->avatar}}
                            @endif
                            " class="img-responsive" alt="user-img" />
            </div><!-- end columns -->
            <div class="" style="margin: 12px">
                <p class="mb-0 font-weight-bold">Something about me:</p>
                <p class="mb-0 ">{{ $user->description }}</p>
            </div>
          </div>

        </div>
        
      </div>  
  </div>

  <div class="container ">
        <div class="col-md-12">
            <h1 style="text-align:center">CHECK OUT MY TOURS</h1>
        </div>
        <div class="row">
            @foreach($tours as $tour)     
            <?php 
               $arr_image = explode ( ',' , $tour->image,-1);
            ?>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
              <a href="{{ route('get-page-tourdetail-view',['id'=>$tour->id]) }}" class="unit-1 text-center">
                <img src="images/{{ $arr_image[0] }}" style="width:350px;height:400px;" alt="Image" class="img-fluid">
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
        </div>
      </div>
    
{{-- intro  --}}
@include('page.main.layouts.intro')
{{-- hết intro --}}
@endsection