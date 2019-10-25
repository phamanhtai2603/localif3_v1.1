@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
Thêm mới phòng
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
                              <li><a href="{{ route('tour.index') }}">Quản lý danh sách tour</a></li>
                              <li><a href="{{ route('tour.create') }}">Thêm mới tour</a></li>
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
            <strong> Thêm mới phòng</strong>
		</div>

		@if (session('noti'))
			<div class="alert alert-success">{{ session('noti') }}</div>
		@endif
		@if (session('errorSQL'))
			<div class="alert alert-danger">{{ session('errorSQL') }}</div>
		@endif

        <div class="card-body card-block">
          {{-- form data --}}
		<form id="data_add" action="{{ route('tour.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
            {{ csrf_field() }}
            <div class="row">
              	<div class="col-8">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="name" class=" form-control-label">Tên tour<span class="text text-danger">*</span></label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="name" placeholder="Tên tour"
                            value="{{old('name')}}" class="form-control" data-parsley-trigger="change" required minlength="3">
                        </div>
                        @if ($errors->has('name'))
                            <small class="form-control-feedback text text-danger">
                                {{ $errors->first('name') }}
                            </small>
                        @endif
                    </div>                    
                  
					<div class="row form-group">
						<div class="col col-md-3"><label for="tourguide_name" class=" form-control-label">Tên HDV <span class="text text-danger">*</span></label></div>
						<div class="col-12 col-md-9">
							<select name="tourguide_id" class="form-control" data-parsley-trigger="change" required >
								@if (count($tourguides) > 0)
									@foreach ($tourguides as $tourguide)
										<option value="{{ $tourguide->id }}">{{ $tourguide->first_name.' '.$tourguide->last_name }}</option>
									@endforeach
								@endif
							</select>
						</div>
						@if ($errors->has('tourguide_id'))
							<small class="form-control-feedback text text-danger">
								{{ $errors->first('tourguide_id') }}
							</small>
						@endif
					</div>
                    <div class="row form-group">
                            <div class="col col-md-3"><label for="location_id" class=" form-control-label">Địa điểm <span class="text text-danger">*</span></label></div>
                            <div class="col-12 col-md-9">
                                <select name="location_id" class="form-control" data-parsley-trigger="change" required >
                                    @if (count($locations) > 0)
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('location_id'))
                                <small class="form-control-feedback text text-danger">
                                    {{ $errors->first('location_id') }}
                                </small>
                            @endif
                    </div>

                    <div class="form-group" id="text-area">
                            <div class=""><label for="textarea-input" class=" form-control-label">Mô tả *:</label></div>
                            <div class=""><textarea name="description" id="" rows="9" cols="9" placeholder="Mô tả ngắn gọn.." class="form-control" data-parsley-trigger="change" required=""></textarea></div>
                            @if($errors->has('description'))
                                <small class="text-danger w-100">
                                    {{$errors->first('description')}}
                                </small>
                            @endif
                    </div>

                    <div class="form-group" id="text-area">
                            <div class=""><label for="textarea-input" class=" form-control-label">Nội dung chính của tour *:</label></div>
                            <div class=""><textarea name="content" id="editor" rows="13" cols="9" placeholder="Điều đặc biệt mà bạn muốn chia sẽ, điều đặc biệt làm nên chuyến đi của bạn" class="form-control" data-parsley-trigger="change" required=""></textarea></div>
                            @if($errors->has('content'))
                                <small class="text-danger w-100">
                                    {{$errors->first('content')}}
                                </small>
                            @endif
                    </div>

                    <div class="form-group" id="text-area">
                            <div class=""><label for="textarea-input" class=" form-control-label">Lịch trình dự tính*:</label></div>
                            <div class=""><textarea name="plan" id="editor" rows="13" cols="9" placeholder="Hãy đưa ra lịch dự định của bạn, trình bày đẹp mắt, dễ hiểu là lợi thế.." class="form-control" data-parsley-trigger="change" required=""></textarea></div>
                            @if($errors->has('plan'))
                                <small class="text-danger w-100">
                                    {{$errors->first('plan')}}
                                </small>
                            @endif
                    </div>

                    <div class="row form-group">
                            <div class="col col-md-3"><label for="name" class=" form-control-label">Giá/ngày/người:<span class="text text-danger">*</span></label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="price" placeholder="Giá.."
                                value="{{old('price')}}" class="form-control" data-parsley-trigger="change" required minlength="3">
                            </div>
                            @if ($errors->has('price'))
                                <small class="form-control-feedback text text-danger">
                                    {{ $errors->first('price') }}
                                </small>
                            @endif
                        </div>        
                    
              	</div>
              	<div class="col-4">
                  	<div class="row form-group">
						<div class="col-12">
							<label for="image" class=" form-control-label">Hình ảnh <span class="text text-danger"></span></label><br/>
							<small class="text text-primary">Đây là hình ảnh chính để hiển thị, bạn có thể bổ sung hình ảnh khác sau</small>
						</div>
						<div class="col-12">
							<img class="mt-4" id="preview_avatar" src="admin_page_asset/images/default_image.png" alt="ảnh đại điện">
							<input type="file" id="image" name="image" class="form-control-file" required value="{{old('image')}}">
						</div>
						@if ($errors->has('image'))
							<small class="form-control-feedback text text-danger">
								{{ $errors->first('image') }}
							</small>
						@endif
                  	</div>
                </div>
            </div>
              <button type="submit" class="btn btn-primary mr-3">
                  <i class="fa fa-dot-circle-o"></i> Lưu
              </button>
              <button type="reset" class="btn btn-danger">
                  <i class="fa fa-ban"></i> Đặt lại
              </button>
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
    $("#image").change(function(){
      readURL(this)
    })
    
    </script>
    <script src="admin_page_asset/js/ckeditor.js"></script>
    <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    {{-- validation with parsley js --}}
    <script src="admin_page_asset/js/validation/parsley.min.js"></script>
@endsection
