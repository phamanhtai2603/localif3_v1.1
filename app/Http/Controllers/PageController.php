<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
class PageController extends Controller
{
    public function view(){
        $tours = Tour::orderBy('avgrate','desc')->take(5)->get();
        return view('page.index',['tours'=>$tours]);
    }
}
