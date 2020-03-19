<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Tour;
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
  
    public function getMonthly($year){ 
      $user = Auth::user();
      $tours = Tour::where('tourguide_id',$user->id)->get();
      $revenue=0;
      $revenue12=0; $revenue1=0; $revenue2=0; $revenue3=0; $revenue4=0; $revenue5=0; 
      $revenue6=0; $revenue7=0; $revenue8=0; $revenue9=0; $revenue10=0; $revenue11=0; 
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
        echo "
            <table id='bootstrap-data-table' class='table table-striped table-bordered' style='text-align:center'>
            <thead>
            <tr>
                <th>Tháng 1</th>
                <th>Tháng 2</th>
                <th>Tháng 3</th>
                <th>Tháng 4</th>
                <th>Tháng 5</th>
                <th>Tháng 6</th>
                <th>Tháng 7</th>
                <th>Tháng 8</th>
                <th>Tháng 9</th>
                <th>Tháng 10</th>
                <th>Tháng 11</th>
                <th>Tháng 12</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>".number_format($revenue1)."</td>
                <td>".number_format($revenue2)."</td>
                <td>".number_format($revenue3)."</td>
                <td>".number_format($revenue4)."</td>
                <td>".number_format($revenue5)."</td>
                <td>".number_format($revenue6)."</td>
                <td>".number_format($revenue7)."</td>
                <td>".number_format($revenue8)."</td>
                <td>".number_format($revenue9)."</td>
                <td>".number_format($revenue10)."</td>
                <td>".number_format($revenue11)."</td>
                <td>".number_format($revenue12)."</td>

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
