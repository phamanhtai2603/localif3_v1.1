<?php

namespace App\Http\Middleware;


use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTourguideLogin
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
            $tourguide = User::find($id);
            if ($tourguide->active == 1 && $tourguide->role == 2) {
                return $next($request);
            } else {
                return back();
            }
        }
    }
}
