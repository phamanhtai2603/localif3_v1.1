<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\BookedTour;
use App\Location;
use App\User;
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
}
