@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
  Chỉnh sửa tour đã đặt
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
                              <li><a href="{{ route('bookedtour.index') }}">Tour đã đặt</a></li>
                              <li><a href="{{ route('get-bookedtour-edit',['id'=>$bookedtour->id]) }}">Chỉnh sửa</a></li>
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
        <div class="card-header row">
            <div class="col col-md-3 alert alert-warning">
                <b>*LƯU Ý: Đối với HDV này, bạn không thể đặt tour vào những ngày:</b> 
            </div>
            <div class="col col-md-9 alert alert-warning" id="unavailableday">
                ************
            </div>
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
        @if(count($errors)>0)
          <div class="alert alert-danger">
               @foreach($errors->all() as $err)
               <?php echo $err."<br/>"; ?>
                @endforeach
          </div>
       @endif
        <div class="card-body card-block">
          {{-- form data --}}
          <form id="data_add" action={{ route('post-bookedtour-update',['id'=>$bookedtour->id])}} method="post" class="form-horizontal" data-parsley-validate="">
            @csrf
            <div class="row form-group">
              <div class="col col-md-3"><label for="tour_id" class=" form-control-label">Tour<span class="text text-danger"></span></label></div>
              <div class="col-12 col-md-9">
                  <input type="text" name="tour_id" class="form-control" value="{{ $bookedtour->tour->name }}" readonly/> 
              </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="tour_id" class=" form-control-label">Chọn khách hàng<span class="text text-danger"></span></label></div>
                <div class="col-12 col-md-9">
                    <input type="text" name="tour_id" class="form-control" value="{{ $bookedtour->user->first_name.' '.$bookedtour->user->first_name}}" readonly/> 
                </div>
              </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Giá tiền <i>(người/ngày):</i><span class="text text-danger"></span></label></div>
                <div class="col-12 col-md-9" id="tour_price">
                    <input type="text" name="tour_price" class="form-control" value="{{ $bookedtour->tour->price }}" id="tour_price" readonly/>                                       		 
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Hướng dẫn viên:<span class="text text-danger"></span></label></div>
                <div class="col-12 col-md-9" id="tourguide">
                     <input type="text" name="tourguide" id="tourguidename" class="form-control" value="{{ $bookedtour->tour->user->first_name.' '.$bookedtour->tour->user->last_name }}" readonly/>   
                </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3"><label for="size" class=" form-control-label">Số người:<span class="text text-danger"></span></label></div>
              <div class="col-12 col-md-9">
                  <input type="number" name="size" placeholder="Số người dự kiến"
                  value="{{ $bookedtour->size }}" class="form-control" data-parsley-trigger="change" required minlength="1">
              </div>
              @if ($errors->has('size'))
                  <small class="form-control-feedback text text-danger">
                      {{ $errors->first('size') }}
                  </small>
              @endif
          </div>    
          <div class="row form-group">
             <div class="col col-md-3"><label for="name" class=" form-control-label">Ngày xuất phát:<span class="text text-danger"></span></label></div>
             <div class="col-12 col-md-9">
                <input type="text"  value="{{ $date_from}}" name="date_from" class="form-control" data-parsley-trigger="change"  required readonly/>                                       		
             </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3"><label for="name" class=" form-control-label">Đến hết ngày:<span class="text text-danger"  ></span></label></div>
              <div class="col-12 col-md-9">
                 <input type="text"  value="{{ $date_to }}"name="date_to" class="form-control " placeholder="Đến hết ngày.."readonly required/>                                       		
              </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3"><label for="name" class=" form-control-label">Trạng thái<span class="text text-danger"  ></span></label></div>           
            <div class="col-12 col-md-9">
                @if($bookedtour->status==0)
                <select style="padding: 0px;font-size: 15px;" name="status" id="bookistatusng_status" class="form-control" data-parsley-trigger="change">                          
                    <option value="0" selected="selected" >Chưa xác nhận</option>
                    <option value="1">Xác nhận</option>
                    <option value="2">Từ chối</option>
                </select>
                @elseif($bookedtour->status==1)
                <select style="padding: 0px;font-size: 15px; " name="status" id="status" class="form-control" data-parsley-trigger="change">                    
                  <option value="1" selected="selected">Đã xác nhận</option>
                  <option value="2">Hủy xác nhận</option>
                </select>
                @elseif($bookedtour->status==2) 
                <select style="padding: 0px;font-size: 15px; " name="status" id="status" class="form-control" data-parsley-trigger="change">  
                  <option value="1" >Xác nhận</option>
                  <option value="2" selected="selected">Đã từ chối</option>
                </select>
                
                @endif
              </div>  
            </div>
        
           <div class="form-group" id="text-area">
              <div class=""><label for="textarea-input" class=" form-control-label">Lời nhắn đến HDV:</label></div>
              <div class=""><textarea name="note" id="editor" rows="9" cols="9" placeholder="Bạn có muốn nhắn gì không..." class="form-control" data-parsley-trigger="change" ></textarea></div>
              @if($errors->has('note'))
                  <small class="text-danger w-100">
                      {{$errors->first('note')}}
                  </small>
              @endif
      </div>

                <button type="submit" class="btn btn-primary mr-5">
                  <i class="fa fa-dot-circle-o"></i> Lưu
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-ban"></i> Đặt lại
                </button>
              </div>
          </form>
          {{-- end form data --}}
        </div>
    </div>
@endsection
@section('script')
    {{-- validation with parsley js --}}
    <script src="admin_page_asset/js/validation/parsley.min.js"></script>
  
@endsection
