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
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary">
                      <a style="color:white;" href="{{route('page-revenue')}}" >Back</a>
                    </button>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    <form id="data_add" action="#" method="post" class="form-horizontal" data-parsley-validate="">
                    @csrf
                        <div style="display: inline-block;">
                          <label>Revenue of </label>
                          <select name="month" id="month" class="form-control" data-parsley-trigger="change" required >
                            <option value="0" selected>this month</option>
                            <option value="1" >last month</option>
                            <option value="2" >2 months ago</option>
                            <option value="3" >3 months ago</option>
                            <option value="4" >4 months ago</option>
                            <option value="5" >5 months ago</option>
                            <option value="6" >6 months ago</option>
                            <option value="7" >7 months ago</option>
                            <option value="8" >8 months ago</option>
                            <option value="9" >9 months ago</option>  
                          </select>
                        </div>
                        <button type="button" id ="btn_post" class="btn btn-primary">See</button>
                    </form>
                </div>
                <div class ="col-md-12" >
                  <table id='bootstrap-data-table' class='table table-striped table-bordered' style='text-align:center'>
                    <thead>
                    <tr>
                        <th style="width:55%">Tour name</th>
                        <th style="width:15%">Total orders</th>
                        <th style="width:10%">Success</th>
                        <th style="width:20%">Total</th>
                    </tr>
                    </thead>
                    <tbody id="revenue" >
                    </tbody>
                </table>
                </div>
            </div>
           </div>
        </div>
    </div>
@endsection

@section('script')
<script>
  $(document).ready(function(){            
    $("#btn_post").click(function(){
      var month=$("#month").val();    
      //alert(month);
      $.get("index.php/user/tourguide/ajax/tour/"+month,function(data){ 
         $("#revenue").html(data); 
      });    
    });
  });
</script>
@endsection