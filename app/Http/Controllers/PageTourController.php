<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\BookedTour;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
class PageTourController extends Controller
{
    public function viewall(){
        $tours = Tour::All();
        return view('page.main.tours',['tours'=>$tours]);
    }

    public function view($id){
        $tour = Tour::find($id);
        return view('page.main.tour.tourdetail',['tour'=>$tour]);
    }

    public function booktour(Request $request,$id){
        $bookedtour = new BookedTour();
        //Hàm đổi giây sang days
        function secondsToTime($seconds) {
            $dtF = new DateTime('@0');
            $dtT = new DateTime("@$seconds");
            return $dtF->diff($dtT)->format('%a');
        }
        try{
            
            $bookedtour->tour_id = $id;
            $bookedtour->customer_id = Auth::user()->id;
            $bookedtour->booked_user = Auth::user()->email;
            $bookedtour->size = $request->size;
            if($request->size<=0){
                return back()->with('errorSQL', 'Miximun size is one!');
            }
            $bookedtour->note=$request->note;
            //Tính days từ date_from đến date_to
            $date_fromsecond = strtotime($date_from = $request->date_from);
            $date_tosecond = strtotime($date_to = $request->date_to);
            $second = $date_tosecond - $date_fromsecond;
            $days=secondsToTime($second)+1;
            
            //
           
            $bookedtour->total_price = $bookedtour->size*$bookedtour->tour->price*$days;
            
            //Xử lí unvailable
            if($second>=0){
                $unavailableday='';
                for($i=0;$i<=$days-1;$i++){
                    $date_nextsecond = $date_fromsecond + 86400*$i;
                    //$date_2=secondsToTime($date_2);
                    $day_next = date('Y/m/d ',$date_nextsecond); 
                    $bookedtour->date .= $day_next.',';
                }
            }else{
                return back()->with('errorSQL', 'Day from must be bigger than finish day!');
            }
            //Tính days current time và date_from - Nếu datefrom < date current thì k cho đặt
            $date_currentsecond = strtotime(Carbon::now()); 
            $date_current = date('Y/m/d', $date_currentsecond); 
            $date_from = date('Y/m/d', $date_fromsecond); 
            if($date_from<$date_current){
                return back()->with('errorSQL', 'Day from is the past');
            }
            //////// 

            //Cắt mảng unvailableday và mảng bookedtour->date ra để so sánh có trùng ngày hay không
            $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
            $arr_bookedtourdate = explode ( ',' , $bookedtour->date,-1);
            $arr_userunavailableday = explode ( ',' , $user->unavailableday,-1);
            //sizeof($arr_bookedtourdate);
            //sizeof(array_diff($arr_bookedtourdate,$arr_userunavailableday));

            if(sizeof($arr_bookedtourdate)==sizeof(array_diff($arr_bookedtourdate,$arr_userunavailableday))){
                $user->unavailableday .= $bookedtour->date;
                $user->save();
                $bookedtour->save();
            }else{
                return back()->with('errorSQL', 'The host is unavailable on this days!');
            }

            return redirect()->route('thanks',['id'=>$bookedtour->$id]);
    
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Error')->withInput();
        }
        return redirect()->back()->with('success', 'Thank you! We will contact to you soon!');
    }

    public function thanks($id){
        $bookedtour = BookedTour::find($id);
        $name = $bookedtour->tour->name;
        $tourguide = $bookedtour->tour->user;
        $tourguide_phone = $bookedtour->tour->user->phone_number;
        $date=$bookedtour->date;
        $size = $bookedtour->size;
        $total_price = $bookedtour->total_price;
        return view('page.main.tour.thanks',['name'=>$name,'tourguide'=>$tourguide,'date'=>$date,'tourguide_phone'=>$tourguide_phone,'size'=>$size,'total_price'=>$total_price]);
    }
}
