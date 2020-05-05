<?php
    use App\Http\Controllers\PageTourController;
    use App\Helpers\Helper;
?>
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
                                <th>Created at</th>
                                <th>Size </th>
                                <th>From</th>
                                <th>To</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th class="mw-241"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (!empty($tour) ) --}}
                            @foreach ($bookedtours as $bookedtour) 
                            <tr>
                               <?php 
                                $date_from = substr($bookedtour->date, 0, 10);
                                $date_to = substr(substr($bookedtour->date,-12),0,10);
                                $checkdone=0;
                                $date_current = date('Y/m/d', $date_currentsecond);
                                if($date_from<$date_current && $bookedtour->status==1){
                                    $checkdone=1;
                                }elseif($date_from<$date_current){
                                    $checkdone=2;
                                }
                                ?>
                                <td class="text-center">{{$stt++}}</td>
                                <td ><a href="{{ route('get-page-tourdetail-view',['id'=>$bookedtour->tour->id]) }}">{{ $bookedtour->tour->name }}</a></td>
                                <td>{{$bookedtour->created_at->format('M d Y')}}</td>
                                <td>{{$bookedtour->size}}</td>
                                <td>{{ PageTourController::cutDateFrom($bookedtour->date) }}</td>
                                <td>{{ PageTourController::cutDateTo($bookedtour->date) }}</td>
                                <td>{{$bookedtour->total_price}}</td>
                                @if($bookedtour->status==0)
                                <td><a style="color:yellowgreen">Unchecked</a></td>
                                @elseif($bookedtour->status==1)
                                <td><a style="color:green">Accepted</a></td>
                                @elseif($bookedtour->status==2)
                                <td><a style="color:red">Refused</a></td>
                                @elseif($bookedtour->status==3)
                                <td><a style="color:red">Canceled</a></td>
                                @endif
                                
                                <td>
                                    @if(($bookedtour->status!=3) && ($bookedtour->status!=2))
                                        @if($bookedtour->status==1 && $checkdone==1)
                                        <a style="color:green; text-align:center">DONE</a>
                                            @if (Helper::checkRated($bookedtour->id))
                                            <button type="button"  class="btn btn-primary"><a style ="color:yellow" href="{{ route('get-page-customerbooked-rate',['id'=>$bookedtour->id]) }}">RATE ME</a></button>
                                            @else
                                            <span>(You have rated)</span>
                                            @endif
                                        @elseif($checkdone==2)
                                        <a style="color:red; text-align:center">Out of date</a>
                                        @else
                                        <a class="btn btn-danger btn-sm btn-op" id="minsize" href="" data-toggle="modal" data-target="#myModalDel{{$bookedtour->id}}" data-backdrop="true"><span><i class="fa fa-trash"></i></span> Cancel</a>
                                        @endif
                                    @endif
                                </td>
                                
                                <div class="modal fade" id="myModalDel{{$bookedtour->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">You want to cancel?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>You have to pay 50% even cancel this tour! OK?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" href="{{ route('get-page-customerbooked-cancel',['id'=>$bookedtour->id]) }}">OK!</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                {{-- <form action="{{  route('user.destroy',['id'=>$user->id]) }}" method="post">
                                                    <input class="btn btn-default" type="submit" value="Xóa" />
                                                    @method('post')
                                                    @csrf
                                                </form> --}}
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