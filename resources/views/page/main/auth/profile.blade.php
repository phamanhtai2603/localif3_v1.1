@extends('page.main.layouts.masterpage')
@section('title')
    All tours
@endsection

@section('content')
{{-- Bìa cover --}}
@include('page.main.layouts.cover')
{{-- Hết bìa cover --}}

<div class="site-section bg-light">
    <div class="container">
        <form action="{{ route('post-page-user-update') }}" enctype="multipart/form-data" method="post" class="p-5 bg-white">
        @csrf
      <div class="row">
        <div class="col-md-7 mb-5">

            <div class="row form-group" >
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">First Name</label>
                <input type="text" id="first_name" value="{{ Auth::user()->first_name }}"class="form-control">
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Last Name</label>
                <input type="text" id="last_name" value="{{ Auth::user()->last_name }}" class="form-control">
              </div>
            </div>

            <div class="row form-group">
              
              <div class="col-md-12">
                <label class="text-black" for="email">Phone</label> 
                <input type="number" id="email" name ="phone_number" value="{{ Auth::user()->phone_number }}" class="form-control">
              </div>
            </div>
            <div class="row form-group">
              
              <div class="col-md-12">
                <label class="text-black" for="subject">Date of birth</label> 
                <input id="date_of_birth" name="date_of_birth" type="date" value="{{substr(Auth::user()->date_of_birth,0,-9)}}" placeholder="Ngày sinh" class="form-control">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="address">Address</label> 
                <input name="address" value="{{ Auth::user()->address}}" id="address" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here...">
              </div>
            </div>
           
            <div class="row form-group">
                <div class="col-md-4">
                  <label class="text-black" for="message">Gender</label> 
                  <select id="gender" name="gender" id="select" class="form-control">
                    @if (Auth::user()->gender == 1)
                        <option value="0">Nữ</option>
                        <option value="1" selected>Nam</option>
                    @else
                        <option value="0" selected>Nữ</option>
                        <option value="1">Nam</option>
                    @endif
                </select>
                </div>
                <div class="col-md-8">
                    <label class="text-black" for="password">New password</label> 
                    <input id="password" name="password" type="text" value="" placeholder="Enter newpassword" class="form-control"/>
                </div>
            </div>
           <div class="row form-group">
            <div class="col-md-12">
                <label class="text-black" for="message">Description</label> 
                <textarea name="description" id="text" cols="30" rows="7" class="form-control" placeholder="Write about yourself..">{{ Auth::user()->description}}</textarea>
            </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Save profile" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </div>


          
        </div>
        <div class="col-md-5">
          
          <div class="p-4 mb-3 bg-white">
 
            <p class="mb-0 font-weight-bold">Email Address</p>
            <p class="mb-0"><a href="#">{{ Auth::user()->email }}</a></p>

            <p class="mb-0 font-weight-bold">User type</p>
            @if(Auth::user()->role==1)
            <p class="mb-0"><a href="#">Admin</a></p>
            @elseif(Auth::user()->role==2)
            <p class="mb-0"><a href="#">Tourist Guide</a></p>
            @elseif(Auth::user()->role==3)
            <p class="mb-0"><a href="#">Normal</a></p>
            @endif

          </div>
          
          <div class="p-4 mb-3 bg-white">
            <div class="col-sm-6 col-md-4 user-img">
                                                <img id="preview_avatar" width="222px" src="
                            @if (Auth::user()->avatar == null)
                                {{'upload/images/default.png'}}
                            @else
                            {{'upload/images/' . Auth::user()->avatar}}
                            @endif
                            " class="img-responsive" alt="user-img" />
                            <span class="input-edit">
                                <input name="avatar" id="avatar" style="margin-left: 2px; padding-left: 0px" type="file" value="" placeholder="Ảnh đại diện"/>
                                <input name="id" type="hidden" value="{{Auth::user()->id}}">
                            </span>
                </div><!-- end columns -->
          </div>

        </div>
        
      </div>
      </form>
      @if(Auth::user()->id == 2)
      <div class="row">
            <div class="col-md-12">   
              <div class="p-12 mb-12 bg-white">
                    <h1 style="text-align:center">Your own TOURS</h1>
                    @foreach($tours as $tour)  
                    <div class="row" style=" margin: 20px; font-size:20px;border-bottom: 1px solid ;">      
                            <div class="col-md-1 " style=" "><a href="#">{{ $stt++ }}</a></div>
                            <div class="col-md-10 " style=" padding:2px; font-family: Times New Roman; "><a href="{{ route('get-page-tourdetail-view',['id'=>$tour->id]) }}">{{ $tour->name }}</a></div>                   
                    </div>
                    @endforeach
              </div>
             
            </div>
    </div>
    @endif
    
  </div>
      
    
{{-- intro  --}}
@include('page.main.layouts.intro')
{{-- hết intro --}}
@endsection