@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Quản lý địa điểm
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
                              <li><a href="{{ route('location.index') }}">Địa điểm</a></li>    
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
                  <strong class="card-title">Địa điểm</strong>
                  <a class="btn btn-primary btn-md" href="{{ route('location.create') }}"><span><i class="fa fa-plus"></i></span> Thêm mới</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
              </div>
              <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên địa điểm</th>
                            <th>Ký hiệu</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (!empty($location) )
                        @foreach ($location as $loca)
                        <tr>
                          <td>{{$loca->id}}</td>
                          <td>{{$loca->name}}</td>
                          <td><p>{{$loca->sign}}</p></td>
                          <td>
                            @if ($loca->status == 0)
                              <p class="text text-success">
                                  Đang hoạt động
                              </p>
                            @else
                              <p class="text text-danger">
                                Vô hiệu hóa
                              </p>
                            @endif
                          </td>
                          <td>                                                 
                                <a class="btn btn-success btn-sm mr-2" href="" data-toggle="modal" data-target="#myModal-{{$loca->id}}" data-backdrop="false"> <span><i class="fa fa-eye"></i></span> Xem</a>
                          		<a class="btn btn-warning btn-sm mr-2" href="{{ route('get-location-edit',['id'=>$loca->id]) }}"> <span><i class="fa fa-edit"></i></span> Sửa</a>
                                {{-- <button class="btn btn-danger btn-sm"  data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal{{$loca->id}}"> <span><i class="fa fa-trash"></i></span> Xoá</button> --}}
                                        
                                  <!-- model delete-->
                                  <div style="text-align: left;" id="myModal{{$loca->id}}" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button status="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title alert alert-danger">Xác Nhận</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p><strong>Hiện có {{ count($location) }} tours sử dụng địa điểm này</strong></p>
                                                  <p>Bạn có chắc chắn muốn xóa địa điểm: "{{ $loca->name }}" không?</p>
                                              </div>
                                              <div class="modal-footer">
                                                  <a class="btn btn-danger" href="{{ route('get-location-destroy',['id'=>$loca->id]) }}">Đồng ý xoá</a>
                                                  <button status="button" class="btn btn-default" data-dismiss="modal">Không</button>
                                              </div>
                                          </div>
  
                                      </div>
                                  </div>
                                  <!-- end model-->
                                <div class="modal fade" id="myModal-{{$loca->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Thông tin địa điểm</h4>
                                        <button status="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <table class="table table-boderless">
                                          <tr>
                                            <th>Id: </th>
                                            <td>{{$loca->id}}</td>
                                          </tr>
                                          <tr>
                                            <th>Tên địa điểm </th>
                                            <td>{{$loca->name}}</td>
                                          </tr>
                                          <tr>
                                            <th>Ký hiệu </th>
                                            <td>{{$loca->sign}}</td>
                                          </tr>
                                          <tr>
                                            <th>Mô tả: </th>
                                            <td>{{$loca->description}}</td>
                                          </tr>
                                          <tr>
                                            <th>Trạng thái: </th>
                                            @if($loca->status==0)
                                            <td style="color:green;"> Đang hoạt động</td>
                                            @else 
                                            <td style="color:red;"> Vô hiệu hóa</td>
                                            @endif
                                            {{-- <td style="color:green;">{{$loca->active == 0 ? 'Đang hoạt động': 'Không hoạt động'}}</td> --}}
                                          </tr>
                                        </table>
                                      </div>
                                      <div class="modal-footer">
                                        <a class="btn btn-warning" href="{{ route('get-location-edit',['id'=>$loca->id]) }}"> <span><i class="fa fa-edit"></i></span> Sửa</a>
                                        <button status="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </td>
                            {{-- modal --}}
                            <!-- The Modal -->
                        </tr>
                        @endforeach
                      @endif
                              {{-- end modal --}}
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
@endsection
