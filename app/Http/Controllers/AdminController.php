<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\Helper;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    public function user(){
        return view('admin.user.index');
    }
    public function profile(){
        return view('admin.profile.profile');
    }

    public function update(Request $request, $id){
        // $user=User::where('id',$id)->first();
        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->date_of_birth = $request->date_of_birth;
        // $user->gender = $request->gender;
        // $user->phone_numer = $request->phone_number;
        // $user->address = $request->address;
        // $user->description = $request->description;
        // $user->avatar
        try{
            $input = Helper::updateProfile($id,$request);
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Sửa thành công');
    }
    
    public function updatepassword($id,$request){
        $user=Auth::user();
        dd($user);
        if(bcrypt($request->password)==$user->password){
            return redirect()->back()->with('noti', 'Sửa thành công');
        }else
        return redirect()->back()->with('noti', 'DIE');
        
    }

    
}
