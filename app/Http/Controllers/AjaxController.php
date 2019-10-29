<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;

class AjaxController extends Controller
{
    public function getTour($idTour){
    	$tour = Tour::where('id',$idTour)->get();
    	foreach($tour as $tour)
    	{
           // echo "<option value='".$tour->id."'>".$tour->name." </option>   ";
            echo " 
                    <input type='text' name='tour_price' class='form-control'  value='".$tour->price."'readonly/>                                       		
                    ";
    	}
    }

    public function getTourguide($idTour){
    	$tour = Tour::where('id',$idTour)->get();
        foreach($tour as $tour)
    	{    
            echo "<input type='text' name='tourguide' class='form-control'  value='".$tour->user->first_name.' '.$tour->user->last_name."'readonly/>                                       		
                    ";
        }
    }
}
