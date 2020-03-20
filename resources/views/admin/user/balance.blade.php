@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
Thay đổi số dư tài khoản
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
                          <li><a href="">Thay đổi số dư</a></li>
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
            <h4>Thay đổi số dư
                @if(session('noti'))
                <small class="alert alert-success p-2">
                    {{session('noti')}}
                </small>
                @endif
                @if(session('danger'))
                <small class="alert alert-danger p-2">
                    {{session('danger')}}
                </small>
                @endif
                @if(count($errors)>0)
                <div class="alert alert-danger">
                     @foreach($errors->all() as $err)
                     <?php echo $err."<br/>"; ?>
                      @endforeach
                </div>
                @endif
            </h4>
        </div>
        <div class="card-body card-block">
          {{-- form data --}}
        <form id="data_add" action="{{ route('update-balance',['id'=>$user->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
            @csrf
            <div class="row">
              <div class="col-8">
                <div class="row form-group">
                    <div class="col col-md-4"><label for="select" class=" form-control-label">Tài khoản: </label></div>
                    <div class="col col-md-8"><label for="select" class=" form-control-label">
                        {{ $user->email }}
                    </label></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-4"><label for="select" class=" form-control-label">Số dư hiện tại: </label></div>
                    <div class="col col-md-8"><label for="select" class=" form-control-label">
                        @if($user->balance==null)
                        0
                        @else
                        {{ number_format($user->balance) }} 
                        @endif
                    </label></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-4"><label for="select" class=" form-control-label">Cộng/trừ: </label></div>
                    <div class="col-12 col-md-8">
                        <select name="type" id="select" class="form-control" data-parsley-trigger="change" style="width:100px">
                            <option value="0">Cộng</option>
                            <option value="1" selected>Trừ</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-4"><label  class=" form-control-label">Số tiền muốn cộng/trừ:</label></div>
                    <div class="col-12 col-md-8">
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="balance" placeholder="Số tiền " class="form-control" data-parsley-trigger="change" required="" >
                        @if($errors->has('balance'))
                            <small class="text-danger w-100">
                                {{$errors->first('balance')}}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-4"><label  class=" form-control-label">Nhập mật khẩu:</label></div>
                    <div class="col-12 col-md-8">
                        <input type="password" name="password" placeholder="Mật khẩu của bạn " class="form-control" data-parsley-trigger="change" required="true" >
                    </div>
                </div>
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-dot-circle-o"></i> Xác nhận
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
