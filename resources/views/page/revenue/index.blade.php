@extends('page.layouts.masterpage')
@section('title')
    Revenue
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
                <div class ="col-md-12">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous ">
                      <button id="previous-year" class="page-link">Previous</button>
                    </li>
                    <li>
                      <a class="page-link" id="year_revenue"></a>
                    </li>
                    <li class="paginate_button page-item next" >
                      <button id="next-year" class="page-link">Next</button>
                    </li>
                  </ul>
                  <div id="revenue"></div>
                </div>
                <div class="col-md-12">
                  <div id="charts_con" style="width:100%; height:400px;">
                  </div>
                </div>
              </div>
            </div>
           </div>
        </div>
    </div>
@endsection

@section('script')
<script>
  var year = new Date().getFullYear();
  $("#next-year").click(function(){
    year++;
    $("#year_revenue").html(year);
    $.get("index.php/user/tourguide/ajax/monthly/"+year,function(data){
        $("#revenue").html(data); 
    }); 
  });  
  $("#previous-year").click(function(){
    year--;
    $("#year_revenue").html(year);
    $.get("index.php/user/tourguide/ajax/monthly/"+year,function(data){
        $("#revenue").html(data); 
    }); 
  });  
</script>
<script>
  $(document).ready(function(){    
    $("#year_revenue").html(year);
      $.get("index.php/user/tourguide/ajax/monthly/"+year,function(data){ 
        // alert(data);
         $("#revenue").html(data); 
      });    
  });
</script>

{{-- Charts --}}
<script src="page_asset/js/charts.js"></script>
@endsection