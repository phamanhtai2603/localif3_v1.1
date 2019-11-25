<?php

namespace App\Http\Controllers;
use App\Tour;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\UploadImageService;
use Image;

class PageTourManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::where('tourguide_id',Auth::user()->id)->get();
        return view('page.main.tourmanage.index',['tours' => $tours, 'stt' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();
        return view('page.main.tourmanage.add',['locations'=>$locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour = new Tour();
        try{
            $image_code = '';
            $images = $request->file('file');
            foreach($images as $image)
            {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $image_code .= $new_name.',';
            }   
            $request['image'] = $image_code;
            $tour = $request->all();
            $tour->save();
        }catch (Exception $e) {
            return back()->with('errorSQL', 'Something error!')->withInput();
        }
        return redirect()->back()->with('noti', 'You have add a new tour post!');
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
        //
    }
}
