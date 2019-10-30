@extends('admin.layout.masterpage')

@section('css')
{{-- css validation --}}
    <link rel="stylesheet" href="admin_page_asset/css/parsley.css">
@endsection

@section('title')
  Đặt tour
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
                              <li><a href="{{ route('bookedtour.create') }}">Đặt tour</a></li>
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
          Đặt tour
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
          <form id="data_add" action={{ route('bookedtour.store')}} method="post" class="form-horizontal" data-parsley-validate="">
            @csrf
            <div class="row form-group">
              <div class="col col-md-3"><label for="tour_id" class=" form-control-label">Chọn tour<span class="text text-danger">*</span></label></div>
              <div class="col-12 col-md-9">
                  <select name="tour_id" id="tour_name" class="form-control" data-parsley-trigger="change" required >
                        <option value="" selected></option>
                      @if (count($tours) > 0)
                          @foreach ($tours as $tour)
                              <option value="{{ $tour->id }}">{{ $tour->name}}</option>
                          @endforeach
                      @endif
                  </select>
              </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="tour_id" class=" form-control-label">Chọn khách hàng<span class="text text-danger">*</span></label></div>
                <div class="col-12 col-md-9">
                    <select name="customer_id" id="customer_id" class="form-control" data-parsley-trigger="change" required >
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
              </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Giá tiền <i>(người/ngày):</i><span class="text text-danger"></span></label></div>
                <div class="col-12 col-md-9" id="tour_price">
                {{-- <input type="text" name="tour_price" class="form-control" id="tour_price" readonly/>                                       		 --}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Hướng dẫn viên:<span class="text text-danger"></span></label></div>
                <div class="col-12 col-md-9" id="tourguide">
                {{-- <input type="text" name="tour_price" class="form-control" id="tour_price" readonly/>                                       		 --}}
                </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3"><label for="size" class=" form-control-label">Số người:<span class="text text-danger">*</span></label></div>
              <div class="col-12 col-md-9">
                  <input type="number" name="size" placeholder="Số người dự kiến"
                  value="1" class="form-control" data-parsley-trigger="change" required minlength="1">
              </div>
              @if ($errors->has('size'))
                  <small class="form-control-feedback text text-danger">
                      {{ $errors->first('size') }}
                  </small>
              @endif
          </div>    
          <div class="row form-group">
             <div class="col col-md-3"><label for="name" class=" form-control-label">Ngày xuất phát:<span class="text text-danger">*</span></label></div>
             <div class="col-12 col-md-9">
                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_from" class="form-control " placeholder="Ngày xuất phát.." required/>                                       		
             </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3"><label for="name" class=" form-control-label">Đến hết ngày:<span class="text text-danger">*</span></label></div>
              <div class="col-12 col-md-9">
                 <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_to" class="form-control " placeholder="Đến hết ngày.." required/>                                       		
              </div>
           </div>
           <div class="form-group" id="text-area">
              <div class=""><label for="textarea-input" class=" form-control-label">Lời nhắn đến HDV:</label></div>
              <div class=""><textarea name="content" id="editor" rows="9" cols="9" placeholder="Bạn có muốn nhắn gì không..." class="form-control" data-parsley-trigger="change" ></textarea></div>
              @if($errors->has('note'))
                  <small class="text-danger w-100">
                      {{$errors->first('note')}}
                  </small>
              @endif
      </div>

                <button type="submit" class="btn btn-primary mr-5">
                  <i class="fa fa-dot-circle-o"></i> Đặt tour
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
    <script>
        $(document).ready(function(){               //Mỗi khi f5 trang thì sẽ thực hiện
          $("#tour_name").change(function(){        //mỗi khi id="Hotel" có sự thay đổi thì thực hiện
            var idTour=$(this).val();        //lấy idHotel = chính id Hotel đc chọn 
            $.get("index.php/admin/ajax/bookedtour/"+idTour,function(data){ //Gọi trang ajax lên và tạo một function, truyền dữ liệu vô biến data
               //alert(data);
                $("#tour_price").html(data);       //truyền dữ liệu lên <select id="Room">
                
            });    
            $.get("index.php/admin/ajax/bookedtourguide/"+idTour,function(data){ //Gọi trang ajax lên và tạo một function, truyền dữ liệu vô biến data
              // alert(data);
                $("#tourguide").html(data);       //truyền dữ liệu lên <select id="Room">
            });                                      
          });
        });
    </script>
@endsection
