@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
Thêm mới người dùng
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
                          <li><a href="">Thêm người dùng</a></li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm mới người dùng
                @if(session('noti'))
                <small class="alert alert-success p-2">
                    {{session('noti')}}
                </small>
                @endif
            </h4>
        </div>
        <div class="card-body card-block">
          {{-- form data --}}
        <form id="data_add" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
            @csrf
            <div class="row">
              <div class="col-8">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Họ*</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="email-input" name="first_name" placeholder="Họ" class="form-control" data-parsley-trigger="change" required="" >
                        @if($errors->has('first_name'))
                            <small class="text-danger w-100">
                                {{$errors->first('first_name')}}
                            </small>
                        @endif
                    </div>
              </div>
              <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Tên*</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="email-input" name="last_name" placeholder="Tên" class="form-control" data-parsley-trigger="change" required="" >
                        @if($errors->has('last_name'))
                            <small class="text-danger w-100">
                                {{$errors->first('last_name')}}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email *</label></div>
                    <div class="col-12 col-md-9">
                        <input type="email" id="text-input" name="email" placeholder="Email" class="form-control" data-parsley-trigger="change" required="">
                        @if($errors->has('email'))
                            <small class="text-danger w-100">
                                {{$errors->first('email')}}
                            </s>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="password-input" class=" form-control-label">Mật khẩu *</label></div>
                    <div class="col-12 col-md-9">
                        <input type="password" id="password-input" name="password" placeholder="Mật khẩu" class="form-control" data-parsley-trigger="change" required="">
                        @if($errors->has('password'))
                            <small class="text-danger w-100">
                                {{$errors->first('password')}}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" name="phone_number" placeholder="Số điện thoại" class="form-control" data-parsley-trigger="change">
                        @if($errors->has('phone_number'))
                            <small class="text-danger w-100">
                                {{$errors->first('phone_number')}}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Địa chỉ</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" name="address" placeholder="Địa chỉ" class="form-control" data-parsley-trigger="change">
                        @if($errors->has('address'))
                            <small class="text-danger w-100">
                                {{$errors->first('address')}}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Loại người dùng *</label></div>
                    <div class="col-12 col-md-9">
                        <select name="role" id="select" class="form-control" data-parsley-trigger="change">
                            <option value="1">Quản trị viên</option>
                            <option value="2">Hướng dẫn viên</option>
                            <option value="3">Khách hàng</option>
                        </select>
                        @if($errors->has('role'))
                            <small class="text-danger w-100">
                                {{$errors->first('role')}}
                            </small>
                        @endif
                    </div>
                </div>
              </div>
              <div class="col-4">
                  <div class="row form-group">
                    <div class="col-12"><label for="file-input" class=" form-control-label">Avatar</label></div>
                    <div class="col-12">
                        <img class="my-2" id="preview_avatar" src="admin_page_asset/images/default.png" alt="ảnh đại điện">
                        <input type="file" id="avatar" name="avatar" class="form-control-file">
                        @if($errors->has('avatar'))
                            <small class="text-danger w-100">
                                {{$errors->first('avatar')}}
                            </small>
                        @endif
                    </div>
                  </div>
                </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-2"><label for="textarea-input" class=" form-control-label">Tiểu sử</label></div>
              <div class="col-12 col-md-10"><textarea name="description" id="textarea-input" rows="9" placeholder="Nội dung..." class="form-control" data-parsley-trigger="change"></textarea></div>
          </div>

              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-dot-circle-o"></i> Lưu
              </button>
              <button type="reset" class="btn btn-warning">
                  <i class="fa fa-undo"></i> Đặt lại
              </button>
              <a href="{{route('user.index')}}" class="btn btn-danger">
                    <i class="fa fa-ban"></i> Hủy
                </a>
    </form>
          {{-- end form data --}}
        </div>
    </div>
@endsection
@section('script')
    
  {{-- xem anh trc khi upload --}}
    <script src="admin_page_asset/js/validation/jquery.min.js"></script>
    <script>
    function readURL(file){
      if(file.files && file.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
          $('#preview_avatar').attr('src',e.target.result);
        }
        reader.readAsDataURL(file.files[0]);
      }
    };
    $("#avatar").change(function(){
      readURL(this)
    })
    </script>

    {{-- validation with parsley js --}}
    <script src="admin_page_asset/js/validation/parsley.min.js"></script>


@endsection
