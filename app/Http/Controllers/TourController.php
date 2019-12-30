<?php

namespace App\Http\Controllers;
use App\Tour;
use App\Location;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;
use App\Services\UploadImageService;
use Image;

class TourController extends Controller
{
    public function index(){
        $tours = Tour::orderBy('status', 'desc')->get(); 
        return view('admin.tour.index',['tours' => $tours, 'stt' => 1]);
    }


    public function destroy($id){
        try{
            $tour = Tour::find($id);
            $tour->delete();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Xóa thành công');
        }


    public function create(){
        $user = User::where('role',2)->get();  
        $locations = Location::all();
        return view('admin.tour.add',['tourguides'=>$user,'locations'=>$locations]);
    }

    public function store(Request $request){
        $tour = new Tour();
        try{ 
       $input = Helper::getArrInputTour($request); 
       $tour->create($input); 
        }catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Thêm mới thành công');
   
            // try{ 
            //     if($request->hasFile('file')) {
            //         $images = $request->file('file');
            //         foreach($images as $image)
            //         {
            //             $imagePath = UploadImageService::uploadImage($image,400,400); 
            //            // $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
            //         }
                    
            //     }
            //     $tour = new Tour();
            //     $tour->image = basename($imagePath);
            //     $tour->thumbnail = basename($thumbnailPath);
            //     $input = $request->all();
            //     $tour->create($input);
            // }catch (Exception $e) {
            //     return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
            // }
            // return redirect()->back()->with('noti', 'Thêm mới thành công');
         
    }

    public function edit($id){
        $tour = Tour::find($id);
        $user = User::where('role',2)->get();  
        $locations = Location::all();
        return view('admin.tour.edit',['tour' => $tour,'tourguides'=>$user,'locations'=>$locations]);
    }

    public function update(Request $request, $id){
        try{
            $input = Helper::updateTour($id, $request); //updateTour
       
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Sửa thành công');
        }

    
}
