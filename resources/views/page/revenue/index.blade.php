@extends('page.layouts.masterpage')
@section('title')
    Thanks you!
@endsection
@section('content')
{{-- Bìa cover --}}
@include('page.layouts.cover')
{{-- Hết bìa cover --}}
<div class="site-section bg-light">
        <div class="container">
           <div class="row" >
            <div class="col-md-12" >
              <h1 style="text-align:center; color: #F58543;">REVENUE</h1>
            </div> 
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                  <button type="button" id ="btn_monthly" class="btn btn-primary">Monthly</button>
                  <button type="button" id ="btn_post" class="btn btn-primary">
                    <a style="color:white;" href="{{route('page-get-revenue-tour')}}" >More detail</a>
                  </button>
                </div>
                <div class ="col-md-12" id="revenue_monthly">
                </div>
              </div>
            </div>
           </div>
        </div>
    </div>
@endsection

@section('script')
<script>
  $(document).ready(function(){            
    $("#btn_monthly").click(function(){    
      $.get("index.php/user/tourguide/ajax/monthly/",function(data){ 
        // alert(data);
         $("#revenue_monthly").html(data); 
      });    
    });
  });
</script>
@endsection