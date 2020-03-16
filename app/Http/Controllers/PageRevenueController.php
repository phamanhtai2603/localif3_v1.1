<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageRevenueController extends Controller
{
    public function index(){
      // $chart->dimensions(1000, 500);
      // $chart->responsive(true);

        // $chart = RevenueChart::create('line', 'highcharts')
        //                         ->title('Title')
        //                         ->setLables(['First','Second','Third'])
        //                         ->setValues([5,10,15,50])
        //                         ->setDimensions(1000, 500)
        //                         -setResponsive(true);

        return view('page.revenue.index');
    }
}
