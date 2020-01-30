<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Answer;

use App\Gamble;

class AnswerController extends Controller
{
    public function index(){
        $answers = Answer::all();
        
        return view('answers.index', [
            'answers' => $answers,
        ]); 
        
    }
    
    public function create(){
        $answer = new Answer;

        return view('answers.create', [
            'answer' => $answer,
        ]);
    }
    
    public function store(Request $request){
        
        $this->validate($request,[
                'gamble_id'=>'required|integer',
                'content'=>'required',
            ]);
        
        $exist = Gamble::where('id',$request->gamble_id)->exists();
        $notexist = Answer::where('gamble_id',$request->gamble_id)->exists();
        if($exist && !$notexist){
            $gamble = Gamble::find($request->gamble_id);
            $gamble->answers()->create([
                    'content'=>$request->content,
                ]);
        }else{
            return back();
        }
            
        return redirect('/answer');
            
    }
    
    public function destroy($id){
        
        $answer = Answer::find($id);
        $answer->delete();
        return back();
    }
}
