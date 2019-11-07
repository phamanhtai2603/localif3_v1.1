<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
        //kiểm tra admin hiện tại có bị khóa hay không 
            $user = User::find($id);
            if ($user->active == 1) {
                return $next($request);
            } else {
                Auth::logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect('/login')->with('noti','Tài khoản này đã bị khóa!');
            }
        }
        return redirect('/login')->with('noti','Hãy đăng nhập để truy cập vào trang này');
    }
}
