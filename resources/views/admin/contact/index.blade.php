@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Quản lý liên hệ
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
                          <li><a href="">Dashboard</a></li>
                          <li><a href="{{route('get-contact-view')}}">Quản lý liên hệ</a></li>
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
                  <strong class="card-title">Liên hệ</strong>
                  <a href="{{ route('get-contact-sendMultiMail') }}" class="btn btn-primary" title="Gửi mail đến nhiều người"><span><i class="fa fa-share"></i></span> Gửi thông tin </a>
                  @if (session('noti'))
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Tình trạng</th>
                            <th class="mw-241">Chức Năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getContact as $contact)
                        <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->subject}}</td>
                        <td>
                            @if ($contact->read_at == null)
                                <p class="text text-danger">Chưa đọc</p>
                            @else 
                                <p class="text text-success">Đã đọc</p>
                            @endif
                        </td>
                          <td>
                                <a class="btn btn-success btn-sm mr-2 btn-op" href="" data-toggle="modal" data-target="#myModal-{{$contact->id}}" data-backdrop="false"> <span><i class="fa fa-eye"></i></span> Xem</a>
                                <a class="btn btn-danger btn-sm mr-2 btn-op" href="" data-toggle="modal" data-target="#myModalDel-{{$contact->id}}" data-backdrop="false"> <span><i class="fa fa-eye"></i></span> Xóa</a>
                                <div class="modal fade" id="myModal-{{$contact->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Thông tin liên hệ</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <h6>Tiêu đề:</h6>
                                            </div>
                                            <div class="col-9">
                                                <p class="text-body">{{$contact->subject}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <h6>Người gửi:</h6>
                                            </div>
                                            <div class="col-9">
                                                <p class="text-body">{{$contact->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <h6>Email:</h6>
                                            </div>
                                            <div class="col-9">
                                                <p class="text-body">{{$contact->email}}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <h6>Nội dung:</h6>
                                            <hr>
                                            <p class="text-body">{{$contact->message}}</p>
                                        </div>
                                        <div>
                                            <h6>Tình trạng:</h6>
                                            @if ($contact->read_at == null)
                                                <p class="text text-danger">Chưa đọc</p>
                                            @else 
                                                <p class="text text-success">Đã đọc</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        @if ($contact->read_at == null)
                                        <button class="btn btn-warning" id="markAsRead" data-read="{{ $contact->id }}">Đánh dấu đã đọc</button>
                                        @endif
                                        <a class="btn btn-primary" href="{{ route('get-contact-replyEmail', ['id' => $contact->id]) }}">Trả lời</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                            {{-- modal --}}
                            <!-- modal xóa-->
                            <div class="modal fade" id="myModalDel-{{$contact->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Xác nhận Liên hệ!</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p class="text-body">Bạn đồng ý xóa liên hệ từ <strong>{{$contact->email}}</strong> này không ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-primary" href="{{route('get-contact-delete',['id' => $contact->id])}}">Đồng ý</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
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

      $('#markAsRead').click(function(){
        var data = $(this).attr("data-read")
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/admin/contact/mark-as-read",
            data: {
                id: data
            },
            dataType: "json",
            success: function (response) {
                alert(response.result);
            }
        });
      });
    
    });
  </script>
@endsection
