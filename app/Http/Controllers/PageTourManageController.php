<?php

namespace App\Http\Controllers;
use App\Tour;
use App\BookedTour;
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
        return view('page.tourmanage.index',['tours' => $tours, 'stt' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();
        return view('page.tourmanage.add',['locations'=>$locations]);
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
                $tour->tourguide_id = Auth::user()->id;
                $tour->location_id = $request->location_id;
                $tour->name = $request->name;
                $tour->description = $request->description;
                $tour->content = $request->content;
                $tour->plan = $request->plan;
                $tour->price = $request->price;

                $image_code = '';
                $images = $request->file('file');
                foreach($images as $image)
                {
                 $new_name = date('Y-M-D') . '_' . round(microtime(true) * 1000) . '.'  . $image->getClientOriginalExtension();
                 $image->move(public_path('images'), $new_name); 
                 $image_code .= $new_name.','; 
                }
                $tour->image = $image_code;
                $tour->save();

        }catch (Exception $e) {
            return back()->with('errorSQL', 'Something wrong!')->withInput();
        }
        return redirect()->back()->with('noti', 'You have created a new tour post!');
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
        $tour = Tour::find($id);
        $user = User::where('role',2)->get();  
        $locations = Location::all();
        return view('page.tourmanage.edit',['tour' => $tour,'tourguides'=>$user,'locations'=>$locations]);
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
        $tour = Tour::find($id);
        try{
            $tour->location_id = $request->location_id;
            $tour->name = $request->name;
            $tour->description = $request->description;
            $tour->content = $request->content;
            $tour->plan = $request->plan;
            $tour->price = $request->price;
            $tour->status = $request->status;

            $image_code = '';
            $images = $request->file('file');
            if($request->file('file')){
                foreach($images as $image)
                {
                    $new_name = date('Y-M-D') . '_' . round(microtime(true) * 1000) . '.'  . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name); 
                    $image_code .= $new_name.','; 
                }
            }
            $tour->image = $image_code;
            $tour->save();

        }catch (Exception $e) {
            return back()->with('errorSQL', 'Something wrong!')->withInput();
        }
        return redirect()->back()->with('noti', 'You have updated a new tour post!');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return back()->with('noti', 'Deleted!')->withInput();
    }

    public function delete($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return back()->with('noti', 'Deleted!')->withInput();
    }

}
