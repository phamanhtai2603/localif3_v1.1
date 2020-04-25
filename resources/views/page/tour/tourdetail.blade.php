@extends('page.layouts.masterpage')
@section('title')
    Tour
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
@if(isset($tour))
<div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-7 mb-5">
            <h1 class=" font-weight-light orange" style="color: #F58543;">WELCOME TO MY OWN TRIP! </h1>
            <div  class="p-5 bg-white">
                <div id="slider">
                  <a  class="control_next">></a>
                  <a  class="control_prev"><</a>
                  <ul>
                      <?php
                      $arrs = explode ( ',' , $tour->image);
                      foreach($arrs as $arr){
                      ?>
                        <li style="background-image: url('images/{{$arr}}'); width:540px;height:400px;"></li>
                      <?php
                      }
                      ?>
                  </ul>
                </div>
            </div>
            <br>
            <div  class="p-5 bg-white">
              <p style="font-family: 'Times New Roman', Times, serif; font-size:25px">ABOUT MY SPECIAL TOUR</p>
                <div>
                  <?php echo $tour->content?>
                </div>
            </div>
            <br>
            <div  class="p-5 bg-white">
                <p style="font-family: 'Times New Roman', Times, serif; font-size:25px">PLAN</p>
                  <div>
                    <?php echo $tour->plan?>
                  </div>
              </div>
        </div>
        <div class="col-md-5">
          <div class="p-4 mb-3 bg-white">
              <?php $arrs = explode ( ',' , $tour->image,2); ?>
            <img src="images/{{ $arrs[0] }}" alt="Image" style="width:397px;height:265px;" class="img-fluid mb-4 rounded">
            <h3 class="h4 text-black mb-3" style="font-family: 'Times New Roman', Times, serif; text-align:center">{{ $tour->name }}</h3>
            <div style="text-align:center">
              <p style="font-size:20px"><b>Location: </b><a style="color:#F58543;">{{ $tour->location->name }}</a></p>
              <p style="font-size:20px"><b>PRICE: </b>{{ number_format($tour->price) }} VND/people/day</p>
            </div>
            <div style="text-align:center">
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
                    <a style="font-family: 'Times New Roman', Times, serif">({{ $tour->rate_size }})</a>
                  </div>
            <p>{{ $tour->description }}</p>
            <p><a href="{{ route('get-page-otheruser-profile-view',['id'=>$tour->user->id]) }}" class="btn btn-primary px-4 py-2 text-white">Host by {{ $tour->user->first_name.' '.$tour->user->last_name }}</a></p>
          </div>
          @if(Auth::guest()||($tour->user->id!=Auth::user()->id ))
          <div class="p-4 mb-3 bg-white">
            <form action="{{ route('post-page-booktour',['id'=>$tour->id]) }}" method="POST" enctype="multipart/form-data" class="p-5 bg-white">
              @csrf
              <div class="row form-group">
                  @if (session('success'))
                      <div class="alert alert-success col-md-12">
                        {{session('success')}}
                      </div>
                  @endif
                  @if (session('errorSQL'))
                      <div class="alert alert-danger col-md-12">
                        {{session('errorSQL')}}
                      </div>
                  @endif
                  @if(count($errors)>0)
                    <div class="alert alert-danger col-md-12">
                        @foreach($errors->all() as $err)
                        <?php echo $err."<br/>"; ?>
                          @endforeach
                    </div>
                @endif
                  <div class="col-md-12">
                    <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        The Tourist guide unavailable days!
                      </button>
                      <input type="text" id="Txt_Date" value="{{$busyunavai}}" style="cursor: pointer; width: 308.59px;" readonly >
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">You can not book on this days</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">I got it!</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

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
              @if(Auth::guest())
              <div class="row form-group">
                <div class="col-md-12 ">
                    <input type="" value="You need login to BOOK" class="btn btn-primary py-2 px-4 text-white" readonly>
                </div>
            </div>
              @else
              <div class="row form-group">
                  <div class="col-md-12">
                      <input type="submit" value="BOOK THIS" class="btn btn-primary py-2 px-4 text-white">
                  </div>
              </div>
              @endif
            </form>
          </div>
          @endif
          <div class="p-4 mb-3 bg-white" style="margin-top: 20px">
            <h1 class=" font-weight-light orange" style="color: #F58543;">RATE LIST</h1>
            @if(count($rates)>0)
              @foreach($rates as $rate)
              <div class="col-md-12" style="border-bottom: solid 1px  #F58543; ">
                <div style="margin-top: 8px">
                  <a  href="{{ route('get-page-otheruser-profile-view',['id'=>$rate->user->id]) }}">
                    <img class="user-avatar rounded-circle" width="30px" height="30px" src="
                      @if($rate->user->avatar == null)
                          {{'upload/images/default.png'}}
                      @else
                          {{'upload/images/' . $rate->user->avatar }}
                      @endif
                    " alt="User Avatar">
                    <b>{{ $rate->user->first_name.' '.$rate->user->last_name }}</b></a>({{ $rate->rate }} <span class="fa fa-star checked"></span>)
                  </a>
                </div>
                <div style="margin: 15px">
                  <p>{{ $rate->comment }}</p>
                </div>
              </div>
              @endforeach
            @else
            <h3 class=" font-weight-light" style="color444444"><i>There are no rate!</i></h1>
            @endif
          </div>
        </div>

    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
      <div class="row">
          <div class="col-md-12 bg-white" style="border: 1px solid">
            <div style="border-bottom: 1px solid; color: #F06757">Write a comment:</div>
            <div>
                <form action="{{ route('post-page-write-comment',['id'=>$tour->id]) }}" method="POST" enctype="multipart/form-data" class="p-5 bg-white">
                  @csrf
                  <textarea name="comment" id="note" rows="5" class="form-control" placeholder="Write your comment here..." required></textarea>
                  @if(Auth::guest())
                  <a href="{{ route('get-login') }}" class="btn btn-primary py-1 px-5 text-white" style="float:right; margin:5px">Login to comment</a>
                  @else
                  <input type="submit" value="SEND" class="btn btn-primary py-2 px-4 text-white" style="float:right; margin:5px">
                  @endif
                </form>
            </div>
          </div>
      </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="p-4 mb-3 bg-white">
          <h1 class=" font-weight-light orange" style="color: #F58543;">Comments</h1>
              @if(count($comments)>0)
                @foreach($comments as $comment)
                @if($comment->user->id!=1)
                <div style="margin-top: 8px">
                    <a  href="{{ route('get-page-otheruser-profile-view',['id'=>$comment->user->id]) }}">
                      <img class="user-avatar rounded-circle" width="30px" height="30px" src="
                        @if($comment->user->avatar == null)
                            {{ 'upload/images/default.png' }}
                        @else
                            {{'upload/images/' . $comment->user->avatar }}
                        @endif
                      " alt="User Avatar">
                      <b>{{ $comment->user->first_name.' '.$comment->user->last_name }}</b></a>
                </div>
                <div class="row">
                  <div class="col-md-10" style="margin-top: 15px; border-bottom: solid 1px #F58543 ">
                    <p>{{ $comment->comment }}</p>
                  </div>
                  @if(Auth::user() && (Auth::user()->role==1 || Auth::user()->id==$comment->customer_id || Auth::user()->id==$tour->user->id))
                  <div class="col-md-2">
                    <a href="{{ route('post-page-destroy-comment',['id'=>$comment->id]) }}"><p style="color:red;"><i>Delete</i></p></a>
                  </div>
                  @endif
                </div>
                @else
                <div style="margin-top: 8px">
                    <a>
                      <img class="user-avatar rounded-circle" width="30px" height="30px" src=" {{ 'upload/images/default.png' }}" alt="User Avatar">
                      <b>{{ $comment->non_user}}(Non-User)</b>
                </div>
                <div class="col-md-10" style="margin-top: 15px; border-bottom: solid 1px #F58543 ">
                  <p>{{ $comment->comment }}</p>
                </div>
                @endif
                @endforeach
              </div>
              @else
              <h3 class=" font-weight-light" style="color444444"><i>There are no comments!</i></h1>
              @endif
          </div>
        </div>
      </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script>
    jQuery(document).ready(function ($) {

    $('#checkbox').change(function(){
      setInterval(function () {
          moveRight();
      }, 3000);
    });

    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({ width: slideWidth, height: slideHeight });

    $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

      $('#slider ul li:last-child').prependTo('#slider ul');

      function moveLeft() {
          $('#slider ul').animate({
              left: + slideWidth
          }, 200, function () {
              $('#slider ul li:last-child').prependTo('#slider ul');
              $('#slider ul').css('left', '');
          });
      };

      function moveRight() {
          $('#slider ul').animate({
              left: - slideWidth
          }, 200, function () {
              $('#slider ul li:first-child').appendTo('#slider ul');
              $('#slider ul').css('left', '');
          });
      };

      $('a.control_prev').click(function () {
          moveLeft();
      });

      $('a.control_next').click(function () {
          moveRight();
      });

    });
    $("#Txt_Date").datepicker({
      format: 'yyyy-mm-dd',
      inline: false,
      lang: 'en',
      step: true,
      multidate: true,
      closeOnDateSelect: true
    });
  </script>
@endsection
