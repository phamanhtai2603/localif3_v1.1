@extends('page.layouts.masterpage')
@section('title')
		Tour Manage
@endsection
@section('css')
<link rel="stylesheet" href="page_asset/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600">
<style>
	 .checked{
		color: orange;
		}
		.orange{
		color: 	#F06757
		}
</style>
@endsection
@section('content')
{{-- Bìa cover --}}
@include('page.layouts.cover')
{{-- Hết bìa cover --}}

<div class="site-section bg-light">
		<div class="container">
				<div class="col-md-12">
						<div class="card">
								<div class="card-header">
										<strong class="card-title mr-2">RATE THIS TOUR:</strong>
										@if(session('success'))
										<small id="success" class="alert alert-success p-2">
												{{session('success')}}
										</small>
										@endif
										@if(session('errorSQL'))
										<small id="danger" class="alert alert-danger p-2">
												{{session('errorSQL')}}
										</small>
										@endif
								</div>
								<div class="card-body">
										<form action="{{ route('post-page-customerbooked-rate',['id'=>$bookedtour->id]) }}" method="POST" enctype="multipart/form-data" class="p-5 bg-white">
										@csrf
												<div class="row form-group">
														<div class="col-md-12">
																<label class="text-black" for="rate">How many star you want to rate?(form 1 to 5)</label> 
																<input type="number" name="rate" class="form-control" placeholder="Số người dự kiến"
																value="1" data-parsley-trigger="change" required minlength="1" maxlength="5" style="width:70px">
																<span class="fa fa-star checked" style="transition: none 0s ease 0s; cursor: move; position: relative; top: -36px; left: 76px;"></span>
														</div>
												</div>
												<div class="row form-group">
														<div class="col-md-12">
																<label class="text-black" for="comment">How do you think?</label> 
																<textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
														</div>
												</div> 
												<div class="row form-group">
														<div class="col-md-12">
																<input type="submit" value="Send" class="btn btn-primary py-2 px-4 text-white">
														</div>
												</div>
										</form>
								</div>
						</div>
				</div>
		
	</div>
			
@endsection