<?php use App\Http\Controllers\PageTourController; ?>
@extends('page.layouts.masterpage')
@section('title')
    Manage busy days
@endsection
@section('css')
<link rel="stylesheet" href="page_asset/css/style.css">
@endsection
@section('content')
{{-- Bìa cover --}}
@include('page.layouts.cover')
{{-- Hết bìa cover --}}

<div class="site-section bg-light">
  <div class="container">
		<div class="card">
			<div class="card-header">
					<strong class="card-title mr-2">Your Busy Schedule</strong>
					@if(session('success'))
					<small id="success" class="alert alert-success p-2">
							{{session('success')}}
					</small>
					@endif
					@if(session('error'))
					<small id="error" class="alert alert-danger p-2">
							{{session('error')}}
					</small>
					@endif
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaladd">
							Add busy days
						</button>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							Remove busy days
						</button>
						<div class="modal fade" id="exampleModaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add busy days</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">                
										<form action="{{ route('tourguidebusy-update',['id'=>Auth::user()->id]) }}" method="POST" >
										@csrf
											<input type="text" name="busy_day" id="Txt_Date" value="{{$busyunavai}}" style="cursor: pointer; width: 308.59px;" readonly >
											<button type="submit" >OK!</button>
									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
  </div> 
</div>
@endsection

@section('script')
<script>
	    $("#Txt_Date").datepicker({
      format: 'yyyy-mm-dd',
      inline: false,
      lang: 'en',
      step: true,
      multidate: true,
      closeOnDateSelect: true
    });
  </script>
@endsection