<?php

namespace App\Http\Controllers;
use App\Location;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;

class LocationController extends Controller
{
    public function index(){
        $location = Location::orderBy('status', 'desc')->get(); 
        return view('admin.location.index',['location' => $location, 'stt' => 1]);
    }

    public function create(){
        return view('admin.location.add');
    }

    public function store(StoreLocationRequest $request){
        $location = new Location();
       
    //    $loca_check = Location::where('sign',$request->sign)->take(1)->get();
    //     if(isset($loca_check)){
    //         if($loca_check->sign == ''){
    //             echo 'Cho phep'; die();
    //         }else{
    //             echo 'Da ton tai';die();
    //         }
    //     }else{
    //         echo 'Cho phep them moi';
    //     }
        $validated = $request->validated();
        try{
            $input = Helper::getArrInput2($request);
        
            $location->create($input);
        
            return back()->with('success','Thêm mới địa điểm thành công!!');
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    public function destroy($id){
        try{
            $location = Location::find($id);
            $location->delete();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Xóa thành công');
        }

    public function edit($id){
        $location = Location::find($id);
            return view('admin.location.edit',['location' => $location]);
    }

    public function update(Request $request, $id){
        try{
        $input = Helper::updateLocation($id,$request);
    } catch (Exception $e) {
        return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
    }
    return redirect()->back()->with('success', 'Sửa thành công');
    }

    
}
