<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
class PageController extends Controller
{
    public function view(){
        $tours = Tour::where('status', 0)->orderBy('avgrate','desc')->take(6)->get();
        return view('page.index',['tours'=>$tours]);
    }
}
