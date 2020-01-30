<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gamble;

use Carbon\Carbon;

use App\Comment;

class GamblesController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()){
            $user = \Auth::user();
            $gambles = Gamble::orderBy('created_at','desc')->paginate(10);
            $now = Carbon::now();
            $data = [
                    'user'=>$user,
                    'gambles'=>$gambles,
                    'now'=>$now,
                ];
        }
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:191',
            'title'=>'required|max:30',
            'deadline'=>'required|numeric',
            'minpoint'=>'required|numeric',
        ]);
        
        $deadline = Carbon::now();
        $deadline->addDays($request->deadline);
        $deadline->format('Y/m/d');
        
        $request->user()->gambles()->create([
            'content'=>$request->content,
            'title'=>$request->title,
            'minpoint'=>$request->minpoint,
            'deadline'=>$deadline,
        ]);
        
        return redirect('/');
        
    }
    
    public function destroy($id)
    {
        $gamble = \App\Gamble::find($id);

        if (\Auth::id() === $gamble->user_id) {
            $gamble->delete();
        }

        return back();
    }
    
    public function show($id)
    {
        $user = \Auth::user();
        $comments = Comment::where('gamble_id',$id)->latest()->take(10)->get();
        $gamble = \App\Gamble::find($id);
        $data = [
                    'user'=>$user,
                    'gamble'=>$gamble,
                    'comments' => $comments,
                ];
        
        return view('gambles.show',$data);
    }
    
    public function create()
    {
        
        $gamble = new Gamble;

        return view('gambles.create', [
            'gamble' => $gamble,
        ]);
    }
}
