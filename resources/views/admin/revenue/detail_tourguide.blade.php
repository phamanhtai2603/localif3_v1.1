@extends('admin.layout.masterpage')

@section('css')
{{-- css table --}}
<link rel="stylesheet" href="admin_page_asset/css/lib/datatable/dataTables.bootstrap.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('title')
    Thống kê theo Hướng dẫn viên
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
                              <li><a href="{{ route('revenue.index') }}">Thống kê</a></li>    
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
                    <strong class="card-title mr-2">Thông tin tài khoản</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 user-img">
                            <img id="avatar1" width="222px" src="
                            @if ($user->avatar == null)
                                {{'upload/images/default.png'}}
                            @else
                            {{'upload/images/' . $user->avatar}}
                            @endif
                            " class="img-responsive" alt="user-img" />
                        </div><!-- end columns -->
                        
                        <div class="col-sm-6 col-md-8  user-detail mt-2">
                            <ul class="list-unstyled">
                                <li class="edit"><span>Tên Tài khoản:</span> 
                                    <span class="uppercase-first-letter old-value">
                                        {{ $user->first_name.' '.$user->last_name}}
                                    </span>
                                </li>
                                <li class="edit"><span>Email:</span>
                                    <span id="display_email" style="text-transform: none; font-weight: normal" readonly>
                                        {{ $user->email }}
                                    </span>
                                </li>
                                <li class="edit"><span>Ngày tạo:</span>
                                    <span style="text-transform: none; font-weight: normal">
                                        {{date('d/m/Y',strtotime(substr($user->created_at,0,-9)))}}
                                    </span>
                                </li>
                                <li class="edit"><span>Ngày cập nhật:</span>
                                    <span style="text-transform: none; font-weight: normal">
                                        {{date('d/m/Y',strtotime(substr($user->updated_at,0,-9)))}}
                                    </span>
                                </li>
                            </ul>
                        </div><!-- end columns -->
                        <table class="table table-striped table-bordered">
                            <input type="hidden" value="{{$user->id}}" id="tourguide_id">
                            <thead>
                                <tr>
                                    <th>HDV email</th>
                                    <th>Trạng thái</th>
                                    <th>Tours</th>
                                    <th>Lượt đặt</th>
                                    <th>Thành công</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Số dư</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                    <tr>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->active == 1)
                                                <span class="text-success">{{'Hoạt động'}}</span>
                                            @else
                                                <span class="text-warning">{{'Khóa'}}</span>
                                            @endif
                                        </td>
                                        <td>{{$tours_count}}</td>
                                        <td>{{$bookeds_count}}</td>
                                        <td>{{$bookeds_done_count}}</td>
                                        <td>{{number_format($revenue_tour)}}</td>
                                        <td></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div><!-- end row -->
                </div>
                <div class="card-body">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous ">
                        <button id="previous-year" class="page-link">Previous</button>
                      </li>
                      <li>
                        <a class="page-link" id="year_revenue"></a>
                      </li>
                      <li class="paginate_button page-item next" >
                        <button id="next-year" class="page-link">Next</button>
                      </li>
                    </ul>
                    <div id="revenue">
                    </div>
                </div>
                <div class="card-body">
                    <span style="text-align:center"><h1>Lịch sử tour</h1></span>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>STT</th>
                            <th>Người đặt</th>
                            <th>Tên tour</th>
                            <th>Ngày đặt</th>
                            <th>Trạng Thái</th>
                            <th>Tổng</th>
                        </thead>
                        @foreach($bookedtours as $bookedtour)
                        <tbody>
                            <td>{{ $stt++ }}</td>
                            <td>{{ $bookedtour->booked_user }}</td>
                            <td>{{$bookedtour->tour_name}}</td>
                            <td>{{$bookedtour->created_at}}</td>
                            <td>
                            @if ($bookedtour->status == 1)
                            <p class="text text-success">
                                Đã xác nhận 
                            </p>
                            @else 
                            <p class="text text-danger">
                                Hủy 
                            </p>
                            @endif
                            </td>
                            <td>
                                @if ($bookedtour->status == 1)
                                <p class="text text-success">
                                    {{$bookedtour->total_price}}
                                </p>
                                @else 
                                0
                                @endif
                                </td>
                            </tbody>
                        @endforeach
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
        });
    </script>

<script>
    var id=$('#tourguide_id').val();
    var year = new Date().getFullYear();
    $("#next-year").click(function(){
      year++;
      $("#year_revenue").html(year);
      $.get("index.php/admin/ajax/detailtourguide/"+year+"/"+id,function(data){
          $("#revenue").html(data); 
      }); 
    });  
    $("#previous-year").click(function(){
      year--;
      $("#year_revenue").html(year);
      $.get("index.php/admin/ajax/detailtourguide/"+year+"/"+id,function(data){
          $("#revenue").html(data); 
      }); 
    });  
  </script>

  <script>
    $(document).ready(function(){  
        $("#year_revenue").html(year);
        $.get("index.php/admin/ajax/detailtourguide/"+year+"/"+id,function(data){
          $("#revenue").html(data); 
        });   
    });
    
  </script>
@endsection
