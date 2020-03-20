<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Tour;
use App\User;
use App\BookedTour;
use Illuminate\Http\Request;

class PageRevenueController extends Controller
{
    public function index(){
        return view('page.revenue.index');
    }

    public function tour(){
      return view('page.revenue.tour');
    }
    
    public function chartsAjax($year){
       $array_revenue = $this->monthlyRevenue($year);
        return $array_revenue;
    }

    public function getMonthly($year){ 
        $revenue_arr = $this->monthlyRevenue($year);
        $revenue=0;
        foreach($revenue_arr as $re){
            $revenue +=$re;
        }
        echo "
            <table id='bootstrap-data-table' class='table table-striped table-bordered' style='text-align:center'>
            <thead>
            <tr>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                "; 
                for($i=0; $i<12; $i++) 
                echo "<td>".number_format($revenue_arr[$i])."</td>"; echo"
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

    private function monthlyRevenue($year){
        $user = Auth::user();
        $tours = Tour::where('tourguide_id',$user->id)->get();
        $revenue=0;
        $revenue12=0; $revenue1=0; $revenue2=0; $revenue3=0; $revenue4=0; $revenue5=0; 
        $revenue6=0; $revenue7=0; $revenue8=0; $revenue9=0; $revenue10=0; $revenue11=0; 
        $array_revenue = [];
        //dd(Carbon::now()->month); 
        foreach($tours as $tour)
        {
            $bookeds = BookedTour::where('tour_id',$tour->id)->where('status',1)->get();
            foreach($bookeds as $booked)
            {
                $start_month = substr($booked->date,5, 2);
                $revenue_year = substr($booked->date,0, 4);
                //dd($revenue_year);
                if($revenue_year == $year){
                    $month = $start_month;
                    $revenue += $booked->total_price;
                    switch ($month) {
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
                        case 12:
                            $revenue12 += $booked->total_price;
                            break;         
                    }
                }
            }
        } 
        array_push($array_revenue,$revenue1,$revenue2,$revenue3,$revenue4,$revenue5
        ,$revenue6,$revenue7,$revenue8,$revenue9,$revenue10,$revenue11,$revenue12);
        return $array_revenue;
    }
}
