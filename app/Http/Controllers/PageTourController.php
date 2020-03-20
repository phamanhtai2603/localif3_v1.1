<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\BookedTour;
use App\User;
use App\Rate;
use App\Comment;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\BookingNoti;

class PageTourController extends Controller
{
    public function viewall(){
        $tours = Tour::where('status', 0)->paginate(15);
        return redirect()->route('get-page-view');
    }

    public function locationview($id){
        $tours = Tour::where('location_id',$id)->where('status', 0)->paginate(15);
        return view('page.tours',['tours'=>$tours]);
    }

    public function view($id){
        $tour = Tour::find($id);
        if (!isset($tour) || $tour->status == 1){
            $tours = Tour::where('status', 0)->orderBy('avgrate','desc')->take(6)->get();
            return view('page.index',['tours'=>$tours]);
        }
        $rates = Rate::where('tour_id',$id)->paginate(15);
        $comments = Comment::where('tour_id',$id)->orderBy('id', 'DESC')->paginate(15);
        $busyunavai = $tour->user->unavailableday . $tour->user->busy_day;
        return view('page.tour.tourdetail',['tour'=>$tour,'rates'=>$rates,'comments'=>$comments,'busyunavai'=>$busyunavai]); 
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

            //Cắt mảng unvailableday và mảng bookedtour->date ra để so sánh có trùng ngày hay không
            $user = User::where('id',$bookedtour->tour->tourguide_id)->first();  
            $arr_bookedtourdate = explode ( ',' , str_replace(' ', '', $bookedtour->date),-1); //Xoa dau cach, xong chuyen ve array
            $arr_userunavailableday = explode ( ',' , str_replace(' ', '', $user->unavailableday),-1); 
            //
            $user_busyday = str_replace('-', '/', $user->busy_day);
            $user_busyday = explode ( ',' , $user_busyday,-1);
            // $user_busyunavai = $user_busyday . $arr_userunavailableday;
            $user_busyunavai = array_merge($user_busyday, $arr_userunavailableday);
            

            if(sizeof($arr_bookedtourdate)==sizeof(array_diff($arr_bookedtourdate,$user_busyunavai))){
                $user->save();
                $bookedtour->save();
            }else{
                return back()->with('errorSQL', 'The host is unavailable on this days!');
            }
            //mail send noti
            $customer = Auth::user()->email;
            $email = $user->email;
            Mail::send('page.mail.havebooked', ['customer' => $customer,'bookedtour'=>$bookedtour], function($message) use ($customer,$email) {
                $message->to($email)
                ->subject('Localif3');
                $message->from('phamanhtai263@gmail.com','Localif3 - You have a booking!');
                });
            
            //Noti send noti
            $user->notify(new BookingNoti($bookedtour));

            return redirect()->route('thanks',['id'=>$bookedtour->id]);
    
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Error')->withInput();
        }
        return redirect()->route('thanks',['id'=>$bookedtour->$id]);
    }

    public function thanks($id){
        
        $bookedtour = BookedTour::where('id',$id)->first();
        if($bookedtour->customer_id == Auth::user()->id){
            $name = $bookedtour->tour->name;
            $tourguide = $bookedtour->tour->user;
            $tourguide_phone = $bookedtour->tour->user->phone_number;
            $date=$bookedtour->date;
            $size = $bookedtour->size;
            $total_price = $bookedtour->total_price;
            return view('page.tour.thanks',['name'=>$name,'tourguide'=>$tourguide,'date'=>$date,'tourguide_phone'=>$tourguide_phone,'size'=>$size,'total_price'=>$total_price]);
        }else{
            return redirect()->route('get-page-view');
        }
    }

    public function comment($id,Request $request){
        try{
            $comment = new Comment();
            if((Auth::guest())){
                $comment->customer_id=1;
                $comment->non_user = $request->non_user;
                $comment->comment = $request->comment;
                $comment->tour_id=$id;
            }else{
                $comment->customer_id=Auth::user()->id; 
                $comment->comment = $request->comment;
                $comment->tour_id=$id;
            }
            $comment->save();

        } catch (Exception $e) {
            return back()->with('commentError', 'Error')->withInput();
        }
        return back()->with('commentSuccess', 'You just have commented!')->withInput();
    }

    public function destroyComment($id,Request $request){
        $comment = Comment::Find($id);
        $comment->delete();
        return back()->with('commentSuccess', 'You just have commented!')->withInput();

    }

    public static function cutDateFrom($string){
        $date_from = substr($string, 0, 10);
        return $date_from;
    }

    public static function cutDateTo($string){
        $date_to = substr(substr($string,-12),0,10);
        return $date_to;
    }

    public static function checkDone($date_to){
        $date_currentsecond = strtotime(Carbon::now());
        $date_current = date('Y/m/d', $date_currentsecond);
        if($date_to<$date_current){
            return true;
        }
    }
}
