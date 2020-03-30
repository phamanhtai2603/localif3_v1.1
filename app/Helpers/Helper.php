<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\User;
use App\Rate;
use App\Location;
use App\Tour;
use Illuminate\Support\Facades\File;

class Helper{

    /**
     * uploadFile method
     * @param $imageFile
     * @return string
     */
    public function uploadFile(UploadedFile $imageFile = null)
    {
        $imageName = "user_default.png";
        if ($imageFile) {
            // get file original extention
            $imageExt = $imageFile->getClientOriginalExtension();
            // new file name
            $imageName = date('Y-M-D') . '_' . round(microtime(true) * 1000) . '.' . $imageExt;
            // move file
            $imageFile->move('upload/images/', $imageName);
        }
        return $imageName;
    }

    public function deleteFile($fileName = null)
    {
        $image_path = "upload/images/" . $fileName;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    /**
     * get arr input method
     * @param $request
     * @return arr
     */
    public static function getArrInput(Request $request)
    {
        $imageFile = $request->file('avatar');
        // uploadFile
        $helper = new Helper;
        $avatarName = $helper->uploadFile($imageFile);
        // get arr input
        $arrInput = $request->all();
        if($arrInput['password']!=null){
        $arrInput['password'] = bcrypt($arrInput['password']);
        }
        $arrInput['avatar'] = $avatarName;

        return $arrInput;
    }

    public static function update($id,Request $request)
    {
        $user = User::find($id);
        // call funtion get arr input from app\heplers\helper
        $helper = new Helper;
        $input = $helper->getArrInput($request);
        //khóa bài đăng
        if( ($request->active==0)){
            $tours = Tour::where('tourguide_id',$id)->get();
            foreach($tours as $tour){
                $tour->status=1;
                $tour->save();
            }
        } 
        if($request->active==1){
            $tours = Tour::where('tourguide_id',$id)->get();
            foreach($tours as $tour){
                $tour->status=0;
                $tour->save();
            }
        }
        // nếu mật khẩu null thì không đổi mật khẩu;
        if($input['password']==null){
            $input['password'] = $user['password'];
        }
        // nếu avatar là ảnh mặt định thì không đổi avatars;
        if($input['avatar']== 'default.png'){
            $input['avatar'] = $user['avatar'];
        }

        $user->update($input);
    }
    
    
    public static function updateProfile($id,Request $request)
    {
        $user = User::find($id);
        // call funtion get arr input from app\heplers\helper
        $helper = new Helper;
        $input = $helper->getArrInput($request);

        // nếu mật khẩu null thì không đổi mật khẩu;
        if($input['password']==null){
            $input['password'] = $user['password'];
        }
        //if($input['old_password']!=null && $input['old_password']==$user->)
        // nếu avatar là ảnh mặt định thì không đổi avatars;
        if($input['avatar']== 'default.png'){
            $input['avatar'] = $user['avatar'];
        }

        $user->update($input);
    }

    //////////Tự độ chế - Tài Tóc Dài 
    //getArrInput Location
    public static function getArrInput2(Request $request)
    {
        $imageFile = $request->file('avatar');
        // uploadFile
        $helper = new Helper;
        $avatarName = $helper->uploadFile($imageFile);
        // get arr input
        $arrInput = $request->all();
       

        return $arrInput;
    }

    public static function updateLocation($id,Request $request)
    {
        $locaion = Location::find($id);
        // call funtion get arr input from app\heplers\helper
        $helper = new Helper;
        $input = $helper->getArrInput2($request);    
        $locaion->update($input);
        if($request->status!=0){
            $tours = Tour::where('location_id',$id)->get();
            foreach($tours as $tour){
                $tour->status=1;
                $tour->save();
            }
       }
    }

    public static function getArrInputTour(Request $request)
    {       
        $image_code = '';
        $images = $request->file('file');
        foreach($images as $image)
        {
         $new_name = rand() . '.' . $image->getClientOriginalExtension();
         $image->move(public_path('images'), $new_name);
         $image_code .= $new_name.',';
        }
        
        $request['image'] = $image_code;

        // // get arr input
        $arrInput = $request->all();
        return $arrInput; 
    }

    public static function updateTour($id,Request $request)
    {       
        $tour = Tour::find($id);
        $image_code = '';
        if($request->file('file')){
            $images = $request->file('file');
            foreach($images as $image)
            {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $image_code .= $new_name.',';
            }
            //Lấy request = chuỗi img cũ
            $request['image'] = $tour->image;
            //thêm img mới vào
            $request['image'] .= $image_code;
        }
        // // get arr input
        $arrInput = $request->all();
        $tour->update($arrInput);
            
    }

    public static function checkRated($booked_id){ 
        $rate = Rate::where('bookedtour_id',$booked_id)->get();
        if (count($rate)>0)
            return true;
        return false;
        
    }
}
