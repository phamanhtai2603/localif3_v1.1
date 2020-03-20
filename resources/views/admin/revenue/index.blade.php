@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Thống kê
@endsection


@section('breadcrumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-left">
                      <div class="page-title">
                          <h1>Dashboard</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-right">
                      <div class="page-title">
                          <ol class="breadcrumb text-right">
                          <li><a href="{{ route('get-admin-view') }}">Dashboard</a></li>
                              <li><a href="{{ route('revenue.index') }}">Thống kê - Doanh thu</a></li>    
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('content')
<div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <strong class="card-title">Thống kê - Doanh thu</strong>
                <a class="btn btn-primary btn-md" href="{{route('get-revenue-user')}}"><span><i class="fa fa-plus"></i></span> Xem theo từng HDV</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
              </div>
                <div class="card-body">
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
              <div class="card-body">
                <div id="charts_con" style="width:100%; height:400px;">
                </div>
              </div>
          </div>
      </div>


    </div>
</div><!-- .animated -->
@endsection

@section('script')

  
  <script>
    var year = new Date().getFullYear();
    $("#next-year").click(function(){
      year++;
      $("#year_revenue").html(year);
      $.get("index.php/admin/ajax/monthly/"+year,function(data){
          $("#revenue").html(data); 
      }); 
    });  
    $("#previous-year").click(function(){
      year--;
      $("#year_revenue").html(year);
      $.get("index.php/admin/ajax/monthly/"+year,function(data){
          $("#revenue").html(data); 
      }); 
    });  
  </script>

  <script>
    $(document).ready(function(){  
        var year = new Date().getFullYear();   
        $("#year_revenue").html(year);
        $.get("index.php/admin/ajax/monthly/"+year,function(data){
          $("#revenue").html(data); 
        });   
    });
    
  </script>
    {{-- scrip data table --}}
    <script src="admin_page_asset/js/lib/data-table/datatables.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/jszip.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/vfs_fonts.js"></script>
    <script src="admin_page_asset/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/buttons.print.min.js"></script>
    <script src="admin_page_asset/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="admin_page_asset/js/init/datatables-init.js"></script>
    <script src="admin_page_asset/js/charts.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
      });
    </script>

@endsection
