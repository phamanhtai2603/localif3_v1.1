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
										@if(session('success'))
										<small id="success" class="alert alert-success p-2">
												{{session('success')}}
										</small>
										@endif
								</div>
								<div class="card-body">
									<h1> THANKS FOR RATING </h1>
								</div>
						</div>
				</div>
		
	</div>
			
@endsection