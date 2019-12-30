<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Notifications\TestNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Mail\SendMail;

class PageRegisterController extends Controller
{
    public function view()
    {
        return view('page.main.auth.register');
    }

    public function store(RegistrationRequest $request)
    {   
        $user1 = User::where('email',$request->email)->get();
        if(count($user1)>0){
            return back()->with('noti', 'Email has been used!');
        }

        $verify_code =rand(999,9999);
        $user = User::create([
            'role'  =>$request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_numer'=>$request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verify_code'=> $verify_code,
            'active' => 0
        ]);
        $data=$user;
        $first_name=$request->first_name;
        $email = $request->email;
        Mail::send('page.main.verify.verify', ['code' => $verify_code,'name' => $request->last_name], function($message) use ($first_name, $email) {
            $message->to($email)
            ->subject('Localif3');
            $message->from('phamanhtai263@gmail.com','Localif3 - Verify your new account!');
            });

        // Mail::send('page.main.verify.verify',['code' => $verify_code,'name' => $request->email],function($messenger) use ($user){
        //     $messenger->to($user['email']);
        //     $messenger->subject('Activation Code Here!');
        // });
        return redirect()->to('login')->with('success','Check your email to active account!');
    }
    function verify($code){
        $user = User::where('verify_code',$code)->get();
        // dd($user[0]->username);
        if ($user->count() > 0) {
            $user[0]->active = 1;
            $user[0]->verify_code = null;
            $user[0]->save();
            return redirect('/login')->with('success','You can use your new account now!');
        } else {
            return redirect('/login')->with('noti','Fail!');
        }
    }
     


}
