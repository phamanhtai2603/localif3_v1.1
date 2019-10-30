<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreEditUserRequest;
use App\User;
use App\UnavailableDay;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index(){
        $getUsers = User::orderBy('created_at', 'desc')->get(); 
        return view('admin.user.index',['getUsers' => $getUsers, 'stt' => 1]);
    }

    public function create(){
        return view('admin.user.add');
    }

    public function store(StoreUserRequest $request){
        $user = new User();
        $input = Helper::getArrInput($request);
        $user->create($input);
  
        // $user2=User::where('email',$request->email)->get();
        // dd($user2);
        // $unavailableday = new UnavailableDay();
        // $unavailableday->user_id = $user2->id;
        // $unavailableday->save();
        
        return back()->with('noti','Thêm mới tài khoản thành công!!');
         
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return back()->with('noti','Xóa tài khoản thành công!!');
    }

    public function edit(Request $request, $user){
        $user = User::find($user);
        return view('admin.user.edit',['user' => $user]);
    }

    public function update(Request $request, $id){
           
        $input = Helper::update($id,$request);
        return back()->with('noti','Chỉnh sửa tài khoản thành công!!');

    }
}
