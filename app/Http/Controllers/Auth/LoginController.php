<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminLoginRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }
    
    public function getAdminLogin(){
        return view('admin.auth.login');
    }

    public function postAdminLogin(Request $request){
        // check login here1
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1,'active'=>'1'])) {
                return redirect('/admin');
            } else {
                return redirect('/admin/login')->with('noti','Tài khoản hoặc mật khẩu không hợp lệ');
            }     
    }

    public function logout(Request $request){

        $user = Auth::user();
        if ($user == null) {
            return redirect('/errors/404');
        }
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        
        return redirect('admin/login');
    }

}
