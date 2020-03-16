<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageRevenueController extends Controller
{
    public function index(){
        return view('page.revenue.index');
    }

    public function tour(){
      return view('page.revenue.tour');
  }
}
