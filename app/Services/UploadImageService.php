<?php
namespace App\Services;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
class UploadImageService {
      /**
     * @param UploadFile $file
     * @return String $path
     */
    public static function uploadImage(UploadedFile $file,$width, $height) {
        if(!File::exists(\public_path('/images'))){
            File::makeDirectory(\public_path('/images'), 0777, true, true);
        }
        $imagePath = \public_path('/images');
        $imageName = '';
        if($file) {
            $imageExt = $file->getClientOriginalExtension();
            $imageName = date('Y-M-D') . '-' . round(microtime(true) * 1000).rand() .'.' . $imageExt;
            $file->move($imagePath, $imageName);
        }


        $thumbnailPath = \public_path('/thumbnails');
        $thumbnailName = $width .'x'. $height . '-' . \basename($imageName);  
        $resizeImage = Image::make('public/images/', $imageName);dd($resizeImage);
        
        $resizeImage->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $thumbnailName);
        return  $thumbnailPath . '/' . $thumbnailName;
    }
    /**
     * @param String $path
     * @param Integer $width
     * @param Integer $height
     * @return String $path
     */
    public static function resizeImage($path, $width, $height) {
        if(!File::exists(\public_path('/thumbnails'))){
            File::makeDirectory(\public_path('/thumbnails'), 0777, true, true);
        }
        $thumbnailPath = \public_path('/thumbnails');
        $thumbnailName = $width .'x'. $height . '-' . \basename($path); 
        $resizeImage = Image::make('public/images/', $path);
        
        $resizeImage->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $thumbnailName);
        return  $thumbnailPath . '/' . $thumbnailName;
    }
}