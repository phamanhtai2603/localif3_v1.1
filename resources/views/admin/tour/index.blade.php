@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

{{-- css fix bug UI when open multiple modal --}}
<style>
    body{
        padding: 0 !important;
    }
    .p-5px{
        margin-bottom: 5px !important;
    }
    .my-center{
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .my-center-65{
        width: 40%;
    }
    .my-center-85{
        width: 85%;
    }
</style>

@endsection

@section('title')
    Quản lý danh sách Tour
@endsection

@section('breadcrumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-left">
                      <div class="page-title">
                          <h1>Bảng điều khiển</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-right">
                      <div class="page-title">
                          <ol class="breadcrumb text-right">
                          <li><a href="{{'/admin'}}">Bảng điều khiển</a></li>
                          <li><a href="{{ route('tour.index') }}">Quản lý danh sách tour </a></li>
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
                    <strong class="card-title mr-2">Danh Sách TOUR</strong>
                    <a class="btn btn-primary" href="{{ route('tour.create') }}"><i class="fa fa-plus"></i>Thêm </a>
                    @if(session('success'))
                    <small id="success" class="alert alert-success p-2">
                        {{session('success')}}
                    </small>
                    @endif
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên tour</th>
                                <th>Tên HDV</th>
                                <th>Địa điểm </th>
                                <th>Giá theo tour </th>
                                <th>Trạng thái</th>
                                <th class="mw-241">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (!empty($tour) ) --}}
                            @foreach ($tours as $tour)
                            <tr>
                                
                                <td class="text-center">{{$stt++}}</td>
                                <td>{{ $tour->name }}</td>
                                <td>{{$tour->user->first_name.' '.$tour->user->last_name}}</td>
                                <td>{{$tour->location->name}}</td>
                                <td>{{$tour->price}}</td>
                                <td>
                                    @if($tour->status == 0)
                                        <span class="text-success">{{'Hoạt động'}}</span>
                                    @else
                                        <span class="text-danger">{{'Vô Hiệu Hóa'}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-op" href="" data-toggle="modal" data-target="#myModal{{$tour->id}}" data-backdrop="true"><span><i class="fa fa-eye"></i></span> Xem</a>
                                    <a class="btn btn-warning btn-sm btn-op" href="{{ route('get-tour-edit',['id'=>$tour->id]) }}"><span><i class="fa fa-edit"></i></span> Sửa</a>
                                    <a class="btn btn-danger btn-sm btn-op" href="" data-toggle="modal" data-target="#myModalDel{{$tour->id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Xoá</a>
                                </td>
                                {{-- modal --}}
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal{{$tour->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thông tin tour</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="my-center my-center-95">
                                                    <div class="row">
                                                        <div class="col-4"></div>
                                                        <div class="col-4">
                                                        <a class="btn btn-success btn-sm btn-op" href="" data-toggle="modal" data-target="#myModal2{{$tour->id}}" data-backdrop="true"><span><i class="fa fa-eye"></i></span> Xem ảnh</a> 
                                                        </div>
                                                        <div class="col-4"></div>
                                                    </div>
                                                    <h4 class="text-center mt-2">{{$tour->name}}</h4>
                                                        @if ($tour->status == 0)
                                                            <p  class="text-center p-5px"><small class="text-success">{{'Hoạt động'}}</small></p>
                                                        @else
                                                            <p class="text-center p-5px"><small class="text-danger">{{'Vô hiệu hóa'}}</small></p>
                                                        @endif
                                                    <hr class="my-1">
                                                </div>
                                                <div class="my-center my-center-85">
                                                    <div class="row">
                                                    <p class="col-6 p-5px">Tên HDV :</p><p class="col-6 p-5px text-body">{{ $tour->user->first_name.' '.$tour->user->last_name}}</p>
                                                    </div>
                                                    <div class="row">
                                                    <p class="col-6 p-5px bg-light">Email :</p><p class="col-6 p-5px text-body bg-light">{{$tour->user->email}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px">Địa điểm:</p><p class="col-6 p-5px text-body">{{$tour->location->name}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px bg-light">Mô tả</p><p class="col-6 p-5px text-body bg-light">{{$tour->description }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px">Giá cả</p><p class="col-6 p-5px text-body">{{$tour->price}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px">Đánh giá</p>
                                                        @if($tour->avgrate=='')
                                                        <p class="col-6 p-5px text-body">Chưa có đánh giá nào</p>
                                                        @else
                                                        <p class="col-6 p-5px text-body">{{ $tour->avgrate }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-1">
                                        </div>
                                        <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-comment-index',['id'=>$tour->id]) }}"><i class="fa fa-edit"></i> Xem bình luận</a>
                                                <a class="btn btn-primary" href="{{ route('get-tour-edit',['id'=>$tour->id]) }}"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModal2{{$tour->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                    
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hình ảnh tour</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                    
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                            <?php $arr_img = explode ( ',' , $tour->image,-1) ?>
                                                            @foreach($arr_img as $img)
                                                                <div class="col-6">
                                                                    <img src="images/{{ $img }}" >
                                                                </div>
                                                            @endforeach
                                                            
                                                    </div>
                                                    <hr class="my-1">
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" id="myModalDel{{$tour->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Xác nhận xóa tour!</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Bạn đồng ý xóa tour <strong>{{ $tour->name }}</strong> này không ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-tour-destroy',['id'=>$tour->id]) }}">Đồng ý</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                {{-- <form action="{{  route('user.destroy',['id'=>$user->id]) }}" method="post">
                                                    <input class="btn btn-default" type="submit" value="Xóa" />
                                                    @method('post')
                                                    @csrf
                                                </form> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                            
                            {{-- @endif --}}
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

  <script src="admin_page_asset/js/functionscript.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
    });
    function hideNoti(){
        $('#success').addClass('d-none');
    }
  </script>
@endsection
