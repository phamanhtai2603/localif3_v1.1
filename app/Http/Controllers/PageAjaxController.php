<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\BookedTour;
use App\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageAjaxController extends Controller
{
    public function getMonthly(){ 
        $user = Auth::user();
        $tours = Tour::where('tourguide_id',$user->id)->get();
        $revenue=0;
        $revenue0=0; $revenue1=0; $revenue2=0; $revenue3=0; $revenue4=0; $revenue5=0; 
        $revenue6=0; $revenue7=0; $revenue8=0; $revenue9=0; $revenue10=0; $revenue11=0; 
        //dd(Carbon::now()->month); 
    	foreach($tours as $tour)
    	{
            $bookeds = BookedTour::where('tour_id',$tour->id)->where('status',1)->get();
            foreach($bookeds as $booked)
            {
                $start_month = substr($booked->date,5, 2);
                $month = Carbon::now()->month - $start_month;
                $revenue += $booked->total_price;
                switch ($month) {
                    case 0:
                        $revenue0 += $booked->total_price;
                        break;
                    case 1:
                        $revenue1 += $booked->total_price;
                        break;
                    case 2:
                        $revenue2 += $booked->total_price;
                        break;
                    case 3:
                        $revenue3 += $booked->total_price;
                        break;      
                    case 4:
                        $revenue4 += $booked->total_price;
                        break;    
                    case 5:
                        $revenue5 += $booked->total_price;
                        break;    
                    case 6:
                        $revenue6 += $booked->total_price;
                        break;    
                    case 7:
                        $revenue7 += $booked->total_price;
                        break;   
                    case 8:
                        $revenue8 += $booked->total_price;
                        break; 
                    case 9:
                        $revenue9 += $booked->total_price;
                        break; 
                    case 10:
                        $revenue10 += $booked->total_price;
                        break; 
                    case 11:
                        $revenue11 += $booked->total_price;
                        break;                 
                }
            }
        } 
        echo "
            <table id='bootstrap-data-table' class='table table-striped table-bordered' style='text-align:center'>
            <thead>
            <tr>
                <th>This month</th>
                <th>Last month</th>
                <th>2 months ago</th>
                <th>3 months ago</th>
                <th>4 months ago</th>
                <th>5 months ago</th>
                <th>6 months ago</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>".number_format($revenue0)."</td>
                <td>".number_format($revenue1)."</td>
                <td>".number_format($revenue2)."</td>
                <td>".number_format($revenue3)."</td>
                <td>".number_format($revenue4)."</td>
                <td>".number_format($revenue5)."</td>
                <td>".number_format($revenue6)."</td>
            </tr>
            </tbody>
        </table>
        ";

        echo " 
        <div class ='row'>
            <div class='col-md-1'>
                <label><b>Network: </b></label>
            </div>
            <div class='col-md-6'>
            <label>".number_format($revenue)."</label>      
            </div>     
        </div>                          		
        ";
    }

    public function getTourRevenue($month){ 
        $user = Auth::user();
        $tours = Tour::where('tourguide_id',$user->id)->get();
        $revenue=0;
    	foreach($tours as $tour)
    	{
            $bookeds = BookedTour::where('tour_id',$tour->id)->get();
            $bookeds_count=0;
            $bookeds_done_count=0;
            $revenue_tour=0;
            foreach($bookeds as $booked)
            {   
                $start_month = substr($booked->date,5, 2);

                if(($month==Carbon::now()->month - $start_month)){
                    $bookeds_count += 1;
                    
                    if($booked->status==1){
                        $revenue_tour += $booked->total_price;
                        $bookeds_done_count += 1;
                    }
                }  
            }
            echo "
                <tr>
                    <td>".$tour->name."</td>
                    <td>".$bookeds_count."</td>
                    <td>".$bookeds_done_count."</td>
                    <td>".number_format($revenue_tour)."</td>
                </tr>
            ";
        }
    }
}
