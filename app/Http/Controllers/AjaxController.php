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
            echo "<option value='".$tour->user->id."' readonly>".$tour->user->first_name.' '.$tour->user->last_name." </option>   ";
           //echo "<input type='text' name='tourguide' id='tourguidename' class='form-control'  value='".$tour->user->first_name.' '.$tour->user->last_name."'readonly/>  ";
        }
    }

    public function getTourguideUnav($idTour){
    	$tour = Tour::where('id',$idTour)->get();
    	foreach($tour as $tour)
    	{
            $arrs = explode ( ',' , $tour->user->unavailableday,-1);  
                foreach($arrs as $arr){
                    echo "<a style='color=green'>" .$arr."&emsp;&emsp;&emsp;&emsp;". "</a>";  
                }
            
            //echo " <input type='text' name='unavailableday' class='form-control'  value='".$tour->user->unavailableday."'readonly/>  ";                                     		
                    
    	}
    }
}
