<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\BookedTour;
use App\Location;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PageTourguideBookedTourController extends Controller
{
    public function index(){
        $bookedtours = DB::table('tour')
            ->join('users', 'tour.tourguide_id', '=', 'users.id')
            ->join('bookedtour', 'tour.id', '=', 'bookedtour.tour_id')
            ->select('bookedtour.*','bookedtour.created_at as b_created_at','bookedtour.date as b_date','bookedtour.id as b_id','bookedtour.status as b_status','bookedtour.created_at as b_created_at', 'tour.*','tour.id as t_id','tour.name as t_name', 'users.*','users.id as u_id')
            ->orderBy('b_created_at', 'desc')->get();
            $date_currentsecond = strtotime(Carbon::now()); 
            return view('page.main.tourguidebookedtour.index',['bookedtours' => $bookedtours,'stt'=>1,'date_currentsecond'=>$date_currentsecond]);
    }

    public function deny($id){
        $bookedtour = BookedTour::find($id);
        try{
            if($bookedtour->status==0){
                $bookedtour->status = 2;
                $bookedtour->save();
            }elseif($bookedtour->status==1){
                $date=$bookedtour->date;
                $userunav = Auth::user()->unavailableday;
                $userunav=str_replace($date,'',$userunav);
                Auth::user()->unavailableday = $userunav;
                Auth::user()->save();
                $bookedtour->status = 2;
                $bookedtour->save();
            }

        } catch (Exception $e) {
            return back()->with('errorSQL', 'Something wrong happened!')->withInput();
        }
        return redirect()->back()->with('success', 'You have canceled one tour!');
    }

    //Accept function
    public function accept($id){
        $bookedtour = BookedTour::find($id);
        $condition_to_accept=0;
        try{
          if($bookedtour->status==0){
                $user = Auth::user();
                $arr_bookedtourdate = explode ( ',' , $bookedtour->date,-1);
                $arr_userunavailableday = explode ( ',' , $user->unavailableday,-1);

                //Check avaialable day
                if(sizeof($arr_bookedtourdate)==sizeof(array_diff($arr_bookedtourdate,$arr_userunavailableday))){
                    $bookedtour->status = 1;
                    $bookedtour->save();
                    $user->unavailableday .=$bookedtour->date;
                    $user->save();
                }else{
                    $bookedtour->status = 2;
                    $bookedtour->save();
                    return back()->with('error', 'You are not available this days!');
                }
    
                return back()->with('success','You have accept one tour!!');

            }    
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong happened!')->withInput();
        }
        return redirect()->back()->with('success', 'You have canceled one tour!');
    }
}
