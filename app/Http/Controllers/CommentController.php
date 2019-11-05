<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tour;
use App\Comment;

class CommentController extends Controller
{
    public function indexview($id){
        $comments = Comment::where('tour_id',$id)->orderBy('created_at', 'desc')->get(); 
        return view('admin.comment.index',['comments' => $comments, 'stt' => 1]);
    }

    public function hide($id){
        try{
            $comment = Comment::find($id);
            if($comment->status==0){
                $comment->status=1;
            }else{
                $comment->status=0;
            }
            $comment->save();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Thao tác thành công');
        
    }

    public function destroy($id){
        try{
            $comment = Comment::find($id);
            $comment->delete();
        } catch (Exception $e) {
            return back()->with('errorSQL', 'Có lỗi xảy ra')->withInput();
        }
        return redirect()->back()->with('noti', 'Thao tác thành công');
    }
}
