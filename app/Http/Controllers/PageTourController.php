<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
class PageTourController extends Controller
{
    public function view($id){
        $tour = Tour::find($id);
        return view('page.main.tour.tourdetail',['tour'=>$tour]);
    }
}
