<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\BookedTour;
use App\Location;
use App\User;
use App\Rate;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PageCustomerBookedTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookedtours = BookedTour::where('customer_id',Auth::user()->id)->orderBy('created_at', 'desc')->get(); 
        $stt=1;
        $date_currentsecond = strtotime(Carbon::now()); 

        return view('page.main.customerbookedtour.index',['bookedtours' => $bookedtours,'stt'=>$stt,'date_currentsecond'=>$date_currentsecond]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $bookedtour = BookedTour::find($id);
            $date=$bookedtour->date;
            $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
            $userunav = $user->unavailableday;
            $userunav=str_replace($date,'',$userunav);
            $user->unavailableday = $userunav;
            $user->save();
            $bookedtour->status=3;
            $bookedtour->save();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'You have deleted one tour!');
    }

    public function cancel($id){
        $bookedtour = BookedTour::find($id);
        try{
            if($bookedtour->status==0){
                $bookedtour->status = 3;
                $bookedtour->save();
            }elseif($bookedtour->status==1){
                $date=$bookedtour->date;
                $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
                $userunav = $user->unavailableday;
                $userunav=str_replace($date,'',$userunav);
                $user->unavailableday = $userunav;
                $user->save();
                $bookedtour->status = 3;
                $bookedtour->save();
            }

        } catch (Exception $e) {
            return back()->with('errorSQL', 'Something wrong happened!')->withInput();
        }
        return redirect()->back()->with('success', 'You have canceled one tour!');
    }

    public function getrate($id){
        try{
            $bookedtour = BookedTour::where('id',$id)->first();
            //Check done mới cho rate
            $date_currentsecond = strtotime(Carbon::now());
            $date_current = date('Y/m/d', $date_currentsecond);
            $date_to=substr($bookedtour->date,-12);
            $date_to=substr($date_to,0,10);
            $checkdone=0;
            if($date_to<$date_current && $bookedtour->status==1){
                $checkdone=1;
            }
            // $rate = Rate::where([['customer_id',Auth::user()->id],['bookedtour_id',$id]])->get();
            // if(count($rate)>0){
            //     return back()->with('error', 'You have rated this tour before!');
            // }
            if($bookedtour->have_rate!=0){
                return back()->with('error', 'You have rated this tour before!');
            }

            if($bookedtour->customer_id==Auth::user()->id && $checkdone=1){
                return view('page.main.customerbookedtour.rate',['bookedtour'=>$bookedtour]);
            }else{
                return back()->with('error', 'You can not rate this tour!')->withInput();
            }
        }catch (Exception $e) {
            return back()->with('errorSQL', 'Error')->withInput();
        }
    }

    public function postrate($id, Request $request){
        try{
            if($request->rate>5 || $request->rate<0){
                return back()->with('errorSQL', 'Rate must be from 1 to 5!')->withInput();
            }
            $bookedtour = BookedTour::where('id',$id)->first();
            $bookedtour->have_rate=1;
            $bookedtour->save();

            $rate = new Rate();
            $rate->customer_id = Auth::user()->id;
            $rate->tour_id = $bookedtour->tour->id;
            $rate->bookedtour_id = $id;
            $rate->rate = $request->rate;
            $rate->comment = $request->comment;
            $rate->save();
 
            $tour = Tour::where('id',$bookedtour->tour->id)->first();
            $tour->avgrate = (($tour->avgrate*$tour->rate_size) + $request->rate)/($tour->rate_size+1);
            $tour->rate_size +=1;
            $tour->save();
            
        }catch (Exception $e) {
            return back()->with('errorSQL', 'Error')->withInput();
        }
        return redirect()->route('rate_thanks');
    }
}
