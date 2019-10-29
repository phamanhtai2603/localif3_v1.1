@extends('admin.layout.masterpage')
@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection
@section('title')
  Chỉnh sửa địa điểm
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
                              <li><a href="{{ route('location.index') }}">Địa điểm</a></li>
                              <li><a href="{{ route('get-location-edit', ['id' => $location->id]) }}">Chỉnh sửa</a></li>
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
          Chỉnh sửa địa điểm <h1>{{ $location->name }}</h1>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
              {{session('success')}}
            </div>
        @endif
        @if (session('errorSQL'))
            <div class="alert alert-danger">
              {{session('errorSQL')}}
            </div>
        @endif
        <div class="card-body card-block">
          {{-- form data --}}
          @if (!empty($location))
              
        <form id="data_add" action="{{ route('post-location-update', ['id' => $location->id]) }}" method="POST" class="form-horizontal" data-parsley-validate="">
            @csrf
            <div class="row">
              <div class="col-8">
                <div class="row form-group">
                  <div class="col col-md-3"><label for="email-input" class="form-control-label">Địa điểm <span class="text text-danger">*</span></label></div>
                  <div class="col-12 col-md-9">
                    <input type="number" name="id" value="{{$location->id}}" class="d-none">
                    <input type="text" name="name" id="name" placeholder="Nhập tình tên mới" value="{{$location->name}} " readonly
                        class="form-control" data-parsley-trigger="change" required minlength="2" >
                        @if ($errors->has('name'))
                          <small class="form-control-feedback text-danger">
                            {{$errors->first('name')}}
                          </small>
                        @endif
                  </div>
                </div>   
                <div class="row form-group">
                  <div class="col col-md-3"><label for="email-input" class="form-control-label">Địa điểm <span class="text text-danger">*</span></label></div>
                  <div class="col-12 col-md-9">
                    <input type="number" name="id" value="{{$location->sign}}" class="d-none">
                    <input type="text" name="sign" id="sign" placeholder="Nhập tình tên mới" value="{{$location->sign}}" readonly
                        class="form-control" data-parsley-trigger="change" required minlength="1" >
                        @if ($errors->has('sign'))
                          <small class="form-control-feedback text-danger">
                            {{$errors->first('sign')}}
                          </small>
                        @endif
                  </div>
                </div> 
                <div class="row form-group">
                  <div class="col col-md-3"><label for="description" class=" form-control-label">Mô tả</label></div>
                  <div class="col-12 col-md-9"><textarea name="description" rows="4" cols="50" placeholder="Nội dung..." class="form-control" data-parsley-trigger="change">{{$location->description}}</textarea></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="active" class=" form-control-label">Trạng thái <span class="text text-danger">*</span></label></div>
                  <div class="col-12 col-md-9">
                      <select name="status" class="form-control" data-parsley-trigger="change">
                          <option value="0" {{$location->status == 0 ? 'selected': ''}}>Hoạt động</option>
                          <option value="1" {{$location->status == 1 ? 'selected': ''}}>Vô hiệu hóa</option>
                      </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-5">
                  <i class="fa fa-dot-circle-o"></i> Xác nhận
                </button>
              </div>
          </form>
          {{-- end form data --}}
          @endif

        </div>
    </div>
@endsection

@section('script')
    
    {{-- validation with parsley js --}}
    <script src="admin_page_asset/js/validation/parsley.min.js"></script>
@endsection
