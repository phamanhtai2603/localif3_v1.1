<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Tour;
use Illuminate\Http\Request;

class PageTourguideBusyController extends Controller
{
    public function index(){
        $busyunavai = Auth::user()->unavailableday . Auth::user()->busy_day;
        // $busyunavai = str_replace('/', '-', $busyunavai);
        // $busyunavai = str_replace(' ', '', $busyunavai);
        return view('page.tourguidebusy.index',['busyunavai'=>$busyunavai]);
    }

    public function update($id, Request $request){

        try{
            $user = User::find($id);
            $busydayrequest = explode( ',' , $request->busy_day);

            $user_unavailableday = str_replace('/', '-', $user->unavailableday);
            $user_unavailableday = str_replace(' ', '', $user_unavailableday);
            $user_unavailableday = explode( ',' , $user_unavailableday,-1);

            $user_busyday = explode( ',' , $user->busy_day,-1);
            $result=array_intersect($user_unavailableday,$busydayrequest); //Lấy những ngày trùng giữa user->unavai và busydayrequest
            if(sizeof($result)==sizeof($user_unavailableday)){ //nếu không loại đi ngày cũ nào trong unavailable
                $newbusyday_fromrequest = array_diff($busydayrequest,$user_unavailableday);    //lấy ngày mới thêm vào
                $newbusyday = array_diff($newbusyday_fromrequest,$user_busyday);              //Lọc ngày không trùng với $user->busy_day
                $newbusyday = implode(",",$newbusyday); //convert to string
                $user->busy_day .= $newbusyday.',';
                $user->busy_day = str_replace( ',,', ',', $user->busy_day ); //Xóa bớt 1 dấu ',' nếu như bị lặp
                $user->save();
                return back()->with('success','Success add !!');
            }else{
                return back()->with('error','No permit to remove. You just add more !!');
            }
            return back()->with('success','Success!!');
        }catch (Exception $e) {
            return back()->with('error', 'Error')->withInput();
        }
    }
}
