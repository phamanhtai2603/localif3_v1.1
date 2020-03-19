@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Thống kê theo Hướng dẫn viên
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
                              <li><a href="{{ route('revenue.index') }}">Thống kê</a></li>    
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
              <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>HDV email</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list">
                        @if (!empty($users))
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->active == 1)
                                        <span class="text-success">{{'Hoạt động'}}</span>
                                    @else
                                        <span class="text-warning">{{'Khóa'}}</span>
                                    @endif
                                </td>
                                <td><a class="btn btn-warning btn-sm mr-2" href="{{route('get-revenue-detail',['id'=>$user->id])}}"> <span><i class="fa fa-edit"></i></span> Chi tiết</a><td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
              </div>
          </div>
      </div>


    </div>
</div><!-- .animated -->
@endsection

@section('script')
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

    <script type="text/javascript">
        $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
        });
    </script>

    {{-- <script>
        $(document).ready(function(){   
            $.get("index.php/admin/ajax/tourguides/",function(data){
                $("#list").html(data); 
            });   
        });
        
    </script> --}}
@endsection
