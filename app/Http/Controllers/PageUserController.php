<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Tour;
use App\User;
class PageUserController extends Controller
{
    public function view(){
        $tours = Tour::where('tourguide_id',Auth::user()->id)->get();
        $stt=1;
        return view('page.auth.profile',['tours'=>$tours,'stt'=>$stt]);
    }

    public function update(Request $request){
        try{
        $id = Auth::user()->id;
        $input = Helper::updateProfile($id,$request);
    } catch (Exception $e) {
        return back()->with('error', 'Có lỗi xảy ra')->withInput();
    }
    return redirect()->back()->with('success', 'Sửa thành công');
    }

    //profile cua user khac
    public function userprofileview($id){
            $user = User::Find($id); 
            $tours = Tour::where('tourguide_id',$id)->paginate(6);
            return view('page.user.user_profile',['user'=>$user,'tours'=>$tours]);
    }

}


