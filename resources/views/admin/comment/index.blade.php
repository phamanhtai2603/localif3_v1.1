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
                    <strong class="card-title mr-2">Quản lý bình luận theo tour</strong>
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
                                <th>Tác giả</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng </th>
                                <th>Ngày cập nhật </th>
                                <th>Trạng thái</th>
                                <th class="mw-241">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($comments) )
                            @foreach ($comments as $comment)
                            <tr>
                                
                                <td class="text-center">{{$stt++}}</td>
                                <td>{{ $comment->user->first_name.' '.$comment->user->last_name }}</td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at}}</td>
                                <td>{{$comment->updated_at}}</td>
                                <td>
                                    @if($comment->status == 0)
                                        <span class="text-success">{{'Hiển thị'}}</span>
                                    @else
                                        <span class="text-danger">{{'Ẩn'}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-op" href="" data-toggle="modal" data-target="#myModal{{$comment->id}}" data-backdrop="true"><span><i class="fa fa-eye"></i></span> Xem</a>
                                    @if($comment->status==0)
                                    <a class="btn btn-warning btn-sm btn-op" href="{{ route('get-comment-hide',['id'=>$comment->id]) }}"></i></span> Ẩn</a>
                                    @else 
                                    <a class="btn btn-warning btn-sm btn-op" href="{{ route('get-comment-hide',['id'=>$comment->id]) }}"></i></span> Hiển thị</a>
                                    @endif
                                    <a class="btn btn-danger btn-sm btn-op" href="" data-toggle="modal" data-target="#myModalDel{{$comment->id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Xoá</a>
                                </td>
                                {{-- modal --}}
                                <!-- The Modal -->
                                
                                
                                <div class="modal fade" id="myModalDel{{$comment->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Xác nhận xóa bình luận!</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Bạn đồng ý xóa bình luận này không ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-comment-destroy',['id'=>$comment->id]) }}">Đồng ý</a>
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
                            @else 
                            {{ 'Chưa có bình luận nào' }}
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
