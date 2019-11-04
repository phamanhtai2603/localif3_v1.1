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
    Quản lý người dùng
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
                          <li><a href="">Quản lý người dùng</a></li>
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
                    <strong class="card-title mr-2">Người dùng</strong>
                    <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus"></i>Thêm </a>
                    @if(session('noti'))
                    <small id="success" class="alert alert-success p-2">
                        {{session('noti')}}
                    </small>
                    @endif
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ và tên</th>
                                <th>Tên tài khoản</th>
                                <th>Loại tài khoản</th>
                                <th>Trạng thái</th>
                                <th class="mw-241">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getUsers as $user)
                            <tr>
                                
                                <td class="text-center">{{$stt++}}</td>
                                <td>{{$user->first_name ." ".$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->role == 1)
                                        {{'Quản trị viên'}}
                                    @elseif($user->role==2)
                                        {{'Hướng dẫn viên'}}
                                    @elseif($user->role==3)
                                        {{ 'Khách hàng' }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->active == 1)
                                        <span class="text-success">{{'Hoạt động'}}</span>
                                    @else
                                        <span class="text-warning">{{'Khóa'}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-op" href="" data-toggle="modal" data-target="#myModal{{$user->id}}" data-backdrop="true"><span><i class="fa fa-eye"></i></span> Xem</a>
                                    <a class="btn btn-warning btn-sm btn-op" href="{{ route('get-user-edit',['id'=>$user->id]) }}"><span><i class="fa fa-edit"></i></span> Sửa</a>
                                    <a class="btn btn-danger btn-sm btn-op" href="" data-toggle="modal" data-target="#myModalDel{{$user->id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Xoá</a>
                                </td>
                                {{-- modal --}}
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thông tin tài khoản</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="my-center my-center-65">
                                                    <img src="
                                                    @if($user->avatar == null)
                                                        {{'upload/images/default.png'}}
                                                    @else
                                                        {{'upload/images/'.$user->avatar}}
                                                    @endif    
                                                    " alt="avatar">
                                                    <h4 class="text-center mt-2">{{$user->first_name ." ".$user->last_name}}</h4>
                                                        @if ($user->role == 1)
                                                            <p class="text-center p-5px text-primary">{{'Quản trị viên'}}</p>
                                                        @elseif($user->role == 2)
                                                            <p class="text-center p-5px text-secondary">{{'Hướng dẫn viên'}}</p>
                                                        @else
                                                            <p class="text-center p-5px text-secondary">{{'Khách hàng'}}</p>
                                                        @endif
                                                        @if ($user->active == 1)
                                                            <p class="text-center p-5px"><small class="text-success">{{'Hoạt động'}}</small></p>
                                                        @else
                                                            <p class="text-center p-5px"><small class="text-secondary">{{'Khóa'}}</small></p>
                                                        @endif
                                                    <hr class="my-1">
                                                </div>
                                                <div class="my-center my-center-85">
                                                    <div class="row">
                                                    <p class="col-6 p-5px">Tên đăng nhập :</p><p class="col-6 p-5px text-body">{{$user->username}}</p>
                                                    </div>
                                                    <div class="row">
                                                    <p class="col-6 p-5px bg-light">Email :</p><p class="col-6 p-5px text-body bg-light">{{$user->email}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px">Ngày sinh :</p><p class="col-6 p-5px text-body">
                                                            @if ($user->date_of_birth == null)
                                                                <small>{{'Chưa cập nhật'}}</small>
                                                            @else
                                                                {{substr($user->date_of_birth,0,-9)}}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px bg-light">Giới tính :</p><p class="col-6 p-5px text-body bg-light">
                                                            @if ($user->gender == null)
                                                                <small>{{'Chưa cập nhật'}}</small>
                                                            @else
                                                                @if ($user->gender == 1)
                                                                    {{'Nam'}}                                                                    
                                                                @else
                                                                    {{'Nữ'}}
                                                                @endif
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px">Số điện thoại :</p><p class="col-6 p-5px text-body">{{$user->phone_number}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-6 p-5px bg-light">Địa chỉ :</p><p class="col-6 p-5px text-body bg-light">{{$user->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-1">
                                            <div class="user-description">
                                            <h6>Tiểu sử</h6>
                                            <p>{{$user->description}}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                                <a class="btn btn-primary" href=""><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModalDel{{$user->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Xác nhận tài khoản!</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Bạn đồng ý xóa tài khoản <strong>{{ $user->email }}</strong> này không ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-user-destroy',['id'=>$user->id]) }}">Đồng ý</a>
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
