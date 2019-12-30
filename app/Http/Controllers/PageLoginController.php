<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageLoginController extends Controller
{
    public function getLogin(){
        return view('page.main.auth.login');
    }

    public function postLogin(Request $request ){
        $email = $request->email;
        $password = $request->password;
        $checklogin = array('email' => $email, 'password' => $password,'active'=>'1');
        if (Auth::attempt($checklogin)) {
            return redirect('/');
        }else {
            return redirect('/login')->with('noti','Tài khoản hoặc mật khẩu không hợp lệ');
        }

    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
}
