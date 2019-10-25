<?php

namespace App\Http\Controllers;
use App\Tour;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;

class TourController extends Controller
{
    public function index(){
        $tours = Tour::orderBy('status', 'desc')->get(); 
        return view('admin.tour.index',['tours' => $tours, 'stt' => 1]);
    }

    public function create(){
        $user = User::where('role',2)->get();  
        $locations = Location::all();
        return view('admin.tour.add',['tourguides'=>$user,'locations'=>$locations]);
    }

    public function store(Request $request){
        $tour = new Tour();
        try{
        $input = Helper::getArrInput2($request);
        
        $tour->create($input);
        }catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Thêm mới thành công');
         
    }
}
