@extends('admin.layout.masterpage')

@section('title')
    Gửi email
@endsection

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
    <style>
    .ck-rounded-corners{
        min-height: 588px;
    }
    </style>
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
                          <li><a href="{{route('get-contact-view')}}">Quản lý liên hệ</a></li>
                          <li><a href="{{route('get-contact-replyEmail', ['id' => $contact->id])}}">Trả lời email</a></li>
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
        <h4>Phản hồi email
            @if(session('noti'))
            <small class="alert alert-success p-2">
                {{session('noti')}}
            </small>
            @endif
            @if($errors->has('errorSQL'))
                <small class="text-danger w-100">
                    {{$errors->first('errorSQL')}}
                </small>
            @endif
        </h4>
    </div>
    <div class="card-body card-block">
      {{-- form data --}}
    <form id="data_add" action="{{route('post-contact-handleReplyEmail')}}" method="post"  class="form-horizontal" data-parsley-validate="">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="form-group" id="text-area">
                    <div class=""><label for="textarea-input" class=" form-control-label">Nội dung <span class="text text-danger">*</span> :</label></div>
                    <div class=""><textarea name="description" id="editor" rows="6" cols="9" placeholder="Nội dung..." class="form-control" data-parsley-trigger="change" required="">{{ old('description') }}</textarea></div>
                    @if($errors->has('description'))
                        <small class="text-danger w-100">
                            {{$errors->first('description')}}
                        </small>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class=" form-group">
                   <div class=""><label for="email" class=" form-control-label">Tới ({{ $contact->name }})<span class="text text-danger">*</span>: </label></div>
                   <div class="">
                        <input type="email" name="email" value="{{ $contact->email }}" placeholder="Địa chỉ người nhận" class="form-control" data-parsley-trigger="change" required="" >
                        @if($errors->has('email'))
                        <small class="text-danger w-100">
                            {{$errors->first('email')}}
                        </small>
                  @endif
                    </div>
                </div>
                <div class="form-group">
                   <div class=""><label for="subject" class=" form-control-label">Tiêu đề <span class="text text-danger">*</span> : </label></div>
                   <div class="">
                        <input type="text"  name="subject" value="" placeholder="Tiêu đề" class="form-control" data-parsley-trigger="change" required="">
                        @if($errors->has('subject'))
                        <small class="text-danger w-100">
                            {{$errors->first('subject')}}
                        </small>
                        @endif
                    </div>
                </div>
                <div class=" form-group">
                   <div class=""><label for="active" class=" form-control-label">Gửi bản sao cho admin</label></div>
                   <div class="">
                        <select name="active"  class="form-control" data-parsley-trigger="change">
                            <option value="1">Có</option>
                            <option value="0">Không</option>
                        </select>
                   </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-dot-circle-o"></i> Gửi
                </button>
                <a href="{{route('get-contact-view')}}" class="btn btn-danger">
                    <i class="fa fa-ban"></i> Hủy
                </a>
            </div>
            </div>
      </form>
      {{-- end form data --}}
    </div>
</div>
@endsection
@section('script')
    
  {{-- xem anh trc khi upload --}}
    <script src="admin_page_asset/js/validation/jquery.min.js"></script>

    {{-- validation with parsley js --}}
    <script src="admin_page_asset/js/validation/parsley.min.js"></script>

    {{-- ckedittor --}}
    <script src="admin_page_asset/js/ckeditor.js"></script>
    <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection