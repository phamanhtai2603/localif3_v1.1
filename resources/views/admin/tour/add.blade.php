@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
Thêm mới tour
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
            <strong> Thêm mới tour</strong>
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
                                            <option value="{{ $location->id }}">{{ $location->name}}
                                                @if($location->status==1)
                                                <span class="text text-danger">{{ ' * Địa điểm đã bị vô hiệu hóa * '}}</span>
                                                @endif
                                            </option>
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
						<div class="row">
                            <div class="col-md-3" align="right"><h4>Select Images</h4></div>
                            <div class="col-md-6">
                                <input type="file" name="file[]" id="file" accept="image/*" multiple required />
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0%
                            </div>
                        </div>
                        <br />
                        <div id="success" class="row">
    
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

    {{-- multi image --}}
    <script>
        $(document).ready(function(){
            $('form').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width', '0%');
                },
                uploadProgress:function(event, position, total, percentComplete){
                    $('.progress-bar').text(percentComplete + '0%');
                    $('.progress-bar').css('width', percentComplete + '0%');
                },
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                        $('#success').append(data.image);
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                    }
                }
            });
        });
        </script>
        
@endsection
