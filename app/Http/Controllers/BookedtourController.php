<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\StoreLocationRequest;
use App\BookedTour;
use App\Tour;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class BookedtourController extends Controller
{
    
    public function index(){
        $bookedtours = BookedTour::orderBy('created_at', 'desc')->get(); 
        return view('admin.bookedtour.index',['bookedtours' => $bookedtours, 'stt' => 1]);
    }

    public function create(){
        $tours = Tour::where('status',0)->get();
        $users = User::where('role',3)->get();
        return view('admin.bookedtour.add',['tours'=>$tours,'users'=>$users]);
    }
    function secondsToTime($seconds) {
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
    
    public function store(Request $request){
        $bookedtour = new BookedTour();
        //$validated = $request->validated();
        //Hàm đổi giây sang days
        function secondsToTime($seconds) {
            $dtF = new DateTime('@0');
            $dtT = new DateTime("@$seconds");
            return $dtF->diff($dtT)->format('%a');
        }
        //
    

        
        try{
            
            $bookedtour->tour_id = $request->tour_id;
            $bookedtour->customer_id = $request->customer_id;
            $bookedtour->booked_user = Auth::user()->email;
            $bookedtour->size = $request->size;
            if($request->size<=0){
                return back()->with('errorSQL', 'Số người tối thiểu là 1');
            }
            $bookedtour->note=$request->note;
            //Tính days từ date_from đến date_to
            $date_fromsecond = strtotime($date_from = $request->date_from);
            $date_tosecond = strtotime($date_to = $request->date_to);
            $second = $date_tosecond - $date_fromsecond;
            $days=secondsToTime($second)+1;
            
            //
           
            $bookedtour->total_price = $bookedtour->size*$bookedtour->tour->price*$days;
            
            //Xử lí unvailable
            if($second>=0){
                $unavailableday='';
                for($i=0;$i<=$days-1;$i++){
                    $date_nextsecond = $date_fromsecond + 86400*$i;
                    //$date_2=secondsToTime($date_2);
                    $day_next = date('Y/m/d ',$date_nextsecond); 
                    $bookedtour->date .= $day_next.',';
                }
            }else{
                return back()->with('errorSQL', 'Ngày xuất phát phải nhỏ hơn hoặc bằng ngày kết thúc!');
            }
            //Tính days current time và date_from - Nếu datefrom < date current thì k cho đặt
            $date_currentsecond = strtotime(Carbon::now()); 
            $date_current = date('Y/m/d', $date_currentsecond); 
            $date_from = date('Y/m/d', $date_fromsecond); 
            if($date_from<$date_current){
                return back()->with('errorSQL', 'Ngày xuất phát phải lớn hơn hoặc bằng ngày hiện tại!');
            }
            //////// 

            //Cắt mảng unvailableday và mảng bookedtour->date ra để so sánh có trùng ngày hay không
            $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
            $arr_bookedtourdate = explode ( ',' , $bookedtour->date,-1);
            $arr_userunavailableday = explode ( ',' , $user->unavailableday,-1);
            //sizeof($arr_bookedtourdate);
            //sizeof(array_diff($arr_bookedtourdate,$arr_userunavailableday));

            if(sizeof($arr_bookedtourdate)==sizeof(array_diff($arr_bookedtourdate,$arr_userunavailableday))){
                $user->unavailableday .= $bookedtour->date;
                $user->save();
                $bookedtour->save();
            }else{
                return back()->with('errorSQL', 'Hướng dẫn viên không thể nhận tour vào những ngày này!');
            }

            return back()->with('success','Đặt tour thành công!!');
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Đặt tour thành công?!');
        

    }

    public function destroy($id){
        try{
            $bookedtour = BookedTour::find($id);
            $date=$bookedtour->date;
            $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
            $userunav = $user->unavailableday;
            $userunav=str_replace($date,'',$userunav);
            $user->unavailableday = $userunav;
            $user->save();

            $bookedtour->delete();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function edit(Request $request, $id){
        $bookedtour = BookedTour::find($id);
        $date_from=substr($bookedtour->date,0,10);
        $date_to= substr(substr($bookedtour->date,-12),0,10);
        return view('admin.bookedtour.edit',['bookedtour' => $bookedtour,'date_from'=>$date_from,'date_to'=>$date_to]);
    }

    public function update(Request $request, $id){
        $bookedtour = BookedTour::find($id);
        try{
        $bookedtour->total_price = ($bookedtour->total_price/$bookedtour->size) * $request->size;
        if($bookedtour->status!=$request->status){
            $bookedtour->status = $request->status;
            if($request->status==1){
                $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
                $user->unavailableday .= $bookedtour->date;
                $user->save();
            }
            if($request->status==2){
                $date=$bookedtour->date;
                $user = User::where('id',$bookedtour->tour->tourguide_id)->first();
                $userunav = $user->unavailableday;
                $userunav=str_replace($date,'',$userunav);
                $user->unavailableday = $userunav;
                $user->save();
            }
        }
        $bookedtour->note .= ' Update: '.$request->note;
        $bookedtour->save();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('success', 'Sửa thành công');
    }
    
}
