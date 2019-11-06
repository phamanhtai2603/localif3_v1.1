@extends('page.main.layouts.masterpage')
@section('title')
    Tour
@endsection

@section('content')
{{-- Bìa cover --}}
@include('page.main.layouts.cover')
{{-- Hết bìa cover --}}
<div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-7 mb-5">
            
            <p>Thông tin tour</p>
          
        </div>
        <div class="col-md-5">
          
          
          
          <div class="p-4 mb-3 bg-white">
            <img src="page_asset/images/hero_bg_1.jpg" alt="Image" class="img-fluid mb-4 rounded">
            <h3 class="h5 text-black mb-3">Tên tour</h3>
            <p>Mô tả ngắn về tour</p>
            <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Xem thông tin tourguide</a></p>
          </div>
          <form action="#" class="p-5 bg-white">
            <div class="row form-group">
                <div class="col-md-12">
                        <label class="text-black" for="size">People size</label> 
                        <input type="number" name="size" class="form-control" placeholder="Số người dự kiến"
                        value="1" data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="date_from">From</label> 
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_from" class="form-control" 
                    data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="date_to">To</label> 
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_to" class="form-control"
                    data-parsley-trigger="change" required minlength="1">
                </div>
            </div> 
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="note">Notes</label> 
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
            </div>
    
            <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" value="BOOK THIS" class="btn btn-primary py-2 px-4 text-white">
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection