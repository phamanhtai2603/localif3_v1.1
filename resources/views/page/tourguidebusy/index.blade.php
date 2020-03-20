<?php use App\Http\Controllers\PageTourController; ?>
@extends('page.layouts.masterpage')
@section('title')
    Manage busy days
@endsection
@section('css')
<link rel="stylesheet" href="page_asset/css/style.css">
<style>
	.modal{
		padding-top: 200px;
	}
</style>
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
					<div class="col-md-4">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaladd">
							Add busy days
						</button>
						<div class = "busy-note">
							<span>NOTE:<span class="text text-danger">* </span>Show your all busy days. Include the booking days and the busy days you added by yourself. 
						You can only add more busy day here.</span>
						</div>
					</div>
					<div class="col-md-4 busy-note2">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalremove">
							Remove busy days
						</button>
						<div class = "busy-note"> 
							<span>NOTE:<span class="text text-danger">* </span>Show your busy days you have added by yourself only. If you dont want to take any order
							you can fix your busy schedule</span>
						</div>
					</div>
					<div class="modal fade" id="exampleModaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog margin-popup" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Add busy days</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">                
									<form action="{{ route('tourguidebusy-add',['id'=>Auth::user()->id]) }}" method="POST" >
									@csrf
										<input class="input-busy-date" type="t" name="busyunavai" id="Txt_Date" value="{{$busyunavai}}" readonly >
										<button class="btn-OK-busy" type="submit">OK!</button>
								</form>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="exampleModalremove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog margin-popup" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Remove busy days</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">                
									<form action="{{ route('tourguidebusy-remove',['id'=>Auth::user()->id]) }}" method="POST" >
									@csrf
										<input class="input-busy-date" type="text" name="busy_day" id="Txt_Date2" value="{{$busyday}}" readonly >
										<button class="btn-OK-busy" type="submit" >OK!</button>
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
	$("#Txt_Date2").datepicker({
      format: 'yyyy-mm-dd',
      inline: false,
      lang: 'en',
      step: true,
      multidate: true,
      closeOnDateSelect: true
    });
  </script>
@endsection