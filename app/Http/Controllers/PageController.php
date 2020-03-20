<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Events\MyEvent;
use Pusher\Pusher;

class PageController extends Controller
{
    public function view(){
        $op= array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $p = new Pusher(
            "93b9fa5dd361f3f56497",
            "e95b8c7d612b70b83017",
            "968530",
        );
        $p->trigger('my-channel', 'my-event', [
            'message' => 'hello world'
          ]);
         // dd($p);
        event(new MyEvent('hello world'));
        $tours = Tour::where('status', 0)->orderBy('avgrate','desc')->take(6)->get();
        return view('page.index',['tours'=>$tours]);
    }
}
