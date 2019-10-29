<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;
use App\BookedTour;
use App\Tour;



class BookedtourController extends Controller
{
    
    public function index(){
        $bookedtours = BookedTour::orderBy('created_at', 'desc')->get(); 
        return view('admin.bookedtour.index',['bookedtours' => $bookedtours, 'stt' => 1]);
    }

    public function create(){
        $tours = Tour::where('status',0)->get();
        return view('admin.bookedtour.add',['tours'=>$tours]);
    }
}
