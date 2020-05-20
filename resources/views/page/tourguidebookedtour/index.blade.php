<?php use App\Http\Controllers\PageTourController; ?>
@extends('page.layouts.masterpage')
@section('title')
    Tour Manage
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title mr-2">Your BOOKED TOURS</strong>
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
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Booked by</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th class="mw-241"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (!empty($tour) ) --}}
                            @foreach ($bookedtours as $bookedtour) 
                            <tr>
                               <?php 
                                $date_from = substr($bookedtour->b_date, 0, 10);
                                $date_to = substr(substr($bookedtour->b_date,-12),0,10);
                                $checkdone=0;
                                $date_current = date('Y/m/d', $date_currentsecond);

                                $date_to=substr($bookedtour->b_date,-12);
                                $date_to=substr($date_to,0,10);
                                if($date_to<$date_current){
                                    $checkdone=1;
                                }
                                ?>
                                <td class="text-center">{{$stt++}}</td>
                                <td >{{ $bookedtour->t_name }}</td>
                                <td ><a class="splitName" href="{{ route('get-page-otheruser-profile-view',['id'=>$bookedtour->b_u]) }}">{{ $bookedtour->u_email }}</a></td>
                                <td>{{ PageTourController::cutDateFrom($bookedtour->b_date) }}</td>
                                <td>{{ PageTourController::cutDateTo($bookedtour->b_date) }}</td> 
                                <td><a class="btn btn-success btn-sm btn-op btn-in-table" href="" data-toggle="modal" data-target="#myModalDel3{{$bookedtour->b_id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span>More</a></td>
                                @if($bookedtour->b_status==0)
                                <td><a style="color:yellowgreen">Unchecked</a></td>
                                @elseif($bookedtour->b_status==1)
                                <td><a style="color:green">Accepted</a></td>
                                @elseif($bookedtour->b_status==2)
                                <td><a style="color:red">Refused</a></td>
                                @elseif($bookedtour->b_status==3)
                                <td><a style="color:red">Canceled</a></td>
                                @endif
                                
                                <td>
                                    @if($bookedtour->b_status!=3 && $bookedtour->b_status!=2)        
                                        @if($bookedtour->b_status==1 && $checkdone==1)
                                        <a class="btn-in-table" style="color:green; text-align:center">DONE</a>
                                        @elseif($bookedtour->b_status!=1 && $checkdone==1)
                                        <a style="color:red; text-align:center">Out of date</a>
                                        @elseif($checkdone==0 && $bookedtour->b_status==0)
                                        <a class="btn btn-success btn-sm btn-op btn-in-table" href="" data-toggle="modal" data-target="#myModalDel2{{$bookedtour->b_id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Accept</a>
                                        <a class="btn btn-danger btn-sm btn-op btn-in-table" href="" data-toggle="modal" data-target="#myModalDel{{$bookedtour->b_id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Deny</a>
                                        @elseif($checkdone==0 && $bookedtour->b_status==1)
                                        <a class="btn btn-danger btn-sm btn-op btn-in-table" href="" data-toggle="modal" data-target="#myModalDel{{$bookedtour->b_id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Deny</a>
                                        @endif
                                    @else                                      
                                    @endif
                                </td>
                                
                                <div class="modal fade" id="myModalDel{{$bookedtour->b_id}}">
                                        <div class="modal-dialog">  
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>OK to deny! OK?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-page-tourguidebooked-deny',['id'=>$bookedtour->b_id]) }}">OK!</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="myModalDel2{{$bookedtour->b_id}}">
                                        <div class="modal-dialog">  
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>OK to accept! OK?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-page-tourguidebooked-accept',['id'=>$bookedtour->b_id]) }}">OK!</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModalDel3{{$bookedtour->b_id}}">
                                        <div class="modal-dialog margin-popup">  
                                          <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Message from customer</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <p>{{ $bookedtour->note }}</p>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                            @endforeach
                            
                            {{-- @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
  </div>
      
    

@endsection