<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use App\Gamble;

class CommentsController extends Controller
{
    public function store(Request $request,$id){
        
        $this->validate($request,[
                'content'=>'required',
            ]);
        
        $user=\Auth::user();
        $gamble = Gamble::find($id);
        $gamble->comments()->create([
                'content'=>$request->content,
                'user_id'=>$user->id,
            ]);
        
        return back();
            
    }
    
    public function destroy($id){
        
        $answer = Comment::find($id);
        $answer->delete();
        return back();
    }
}
