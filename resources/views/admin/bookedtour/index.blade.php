@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Quản lý tour đã được đặt
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
                              <li><a href="{{ route('bookedtour.index') }}">Tour đã được đặt</a></li>    
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
                  <strong class="card-title">Tour đã được đặt</strong>
                  <a class="btn btn-primary btn-md" href="{{ route('bookedtour.create') }}"><span><i class="fa fa-plus"></i></span> Đặt tour</a>
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
                            <th>Tên tour</th>
                            <th>Khách hàng</th>
                            <th>Người đặt</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (!empty($bookedtours) )
                        @foreach ($bookedtours as $bookedtour)
                        <tr>
                          <td>{{$bookedtour->id}}</td>
                          <td>{{$bookedtour->tour->name}}</td>
                          <td>{{$bookedtour->user->first_name. ' '. $bookedtour->user->last_name}}</td>
                          <td>{{$bookedtour->booked_user}}</td>
                          <td><p>{{ 'Thời gian đặt' }}</p></td>
                          <td>
                            @if ($bookedtour->status == 0)
                              <p class="text text-warning">
                                  Chưa xác nhận
                              </p>
                            @elseif ($bookedtour->status == 1)
                              <p class="text text-success">
                                  Đã xác nhận 
                              </p>
                            @elseif ($bookedtour->status == 2)
                              <p class="text text-danger">
                                  Đã từ chối
                              </p>  
                            @endif
                          </td>
                          <td>                                                 
                                <a class="btn btn-success btn-sm mr-2" href="" data-toggle="modal" data-target="#myModal-{{$bookedtour->id}}" data-backdrop="false"> <span><i class="fa fa-eye"></i></span> Xem</a>
                          		<a class="btn btn-warning btn-sm mr-2" href="{{ route('get-bookedtour-edit',['id'=>$bookedtour->id]) }}"> <span><i class="fa fa-edit"></i></span> Sửa</a>
                                <button class="btn btn-danger btn-sm"  data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal{{$bookedtour->id}}"> <span><i class="fa fa-trash"></i></span> Xoá</button>
                                        
                                  <!-- model delete-->
                                  <div style="text-align: left;" id="myModal{{$bookedtour->id}}" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button status="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title alert alert-danger">Xác Nhận</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>Bạn có chắc chắn muốn xóa tour: "{{ $bookedtour->tour->name }}" đã được đặt không?</p>
                                              </div>
                                              <div class="modal-footer">
                                                  <a class="btn btn-danger" href="{{ route('get-bookedtour-destroy',['id'=>$bookedtour->id]) }}">Đồng ý xoá</a>
                                                  <button status="button" class="btn btn-default" data-dismiss="modal">Không</button>
                                              </div>
                                          </div>
  
                                      </div>
                                  </div>
                                  <!-- end model-->
                                <div class="modal fade" id="myModal-{{$bookedtour->id}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Thông tin tour</h4>
                                        <button status="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <table class="table table-boderless">
                                          <tr>
                                            <th>Id: </th>
                                            <td>{{$bookedtour->id}}</td>
                                          </tr>
                                          <tr>
                                            <th>Tên tour </th>
                                            <td>{{$bookedtour->tour->name}}</td>
                                          </tr>
                                          <tr>
                                            <th>Ngày khởi tạo </th>
                                            <td>{{$bookedtour->created_at}}</td>
                                          </tr>
                                          <tr>
                                            <th>Người tạo đơn</th>
                                            <td>{{ $bookedtour->booked_user }}</td>
                                          </tr>
                                          <tr>
                                            <th>Khách hàng</th>
                                            <td>{{ $bookedtour->user->first_name. ' '. $bookedtour->user->last_name }}</td>
                                          </tr>
                                          <tr>
                                            <th>Số diện thoại khách hàng</th>
                                            <td>{{ $bookedtour->user->phone_number }}</td>
                                          </tr>
                                          <tr>
                                            <th>Email khách hàng</th>
                                            <td>{{ $bookedtour->user->email }}</td>
                                          </tr>
                                          <tr>
                                            <th>Ngày đi</th>
                                            <td>{{ substr($bookedtour->date,0,10) }}</td>
                                          </tr>
                                          <tr>
                                            <th>Ngày kết thúc</th>
                                            <td>{{ substr($bookedtour->date,-12) }}</td>
                                          </tr>
                                          <tr>
                                            <th>Số người</th>
                                            <td>{{ $bookedtour->size }}</td>
                                          </tr>
                                          <tr>
                                            <th>Ghi chú của khách hàng</th>
                                            <td>{{ $bookedtour->note }}</td>
                                          </tr>
                                          <tr>
                                            <th><b>TỔNG TIỀN</b></th>
                                            <td><b>{{ 'Tổng tiền' }}</b></td>
                                          </tr>
                                          <tr>
                                            <th>Trạng thái: </th>
                                            @if($bookedtour->status==0)
                                            <td style="color:yellow;"> Chưa xác nhận</td>
                                            @elseif($bookedtour->status==1) 
                                            <td style="color:green;"> Đã xác nhận</td>
                                            @else
                                            <td style="color:orange;"> Đã từ chối</td>
                                            @endif
                                            {{-- <td style="color:green;">{{$loca->active == 0 ? 'Đang hoạt động': 'Không hoạt động'}}</td> --}}
                                          </tr>
                                        </table>
                                      </div>
                                      <div class="modal-footer">
                                        <a class="btn btn-warning" href="{{ route('get-bookedtour-edit',['id'=>$bookedtour->id]) }}"> <span><i class="fa fa-edit"></i></span> Sửa</a>
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
