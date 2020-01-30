<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Carbon\Carbon;

use App\Answer;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('point','desc')->paginate(10);
        
        return view('users.index',[
            'users'=>$users,
            ]);
        
    }
    
    public function show($id)
    {
        $user = User::find($id);
        if(\Auth::user() != $user){
            return back();
        }
        $now = Carbon::now();
        $odds=0;
        $arrayOdds = [];
        $arrayAnswers = [];
        foreach($user->get_gambles as $gamble){
            $sum=0;
            $sofy=0;
            $y=0;
            $n=0;
            $uc = $gamble->pivot->choice;
            foreach($gamble->members as $member){
                $sum += $member->pivot->point;
                if ($member->pivot->choice == $uc){
                    $sofy += $member->pivot->point;
                }
                $y += 2-$member->pivot->choice;
                $n += $member->pivot->choice-1;
            }
            if($uc === 1){
                $odds = $y/($y+$n);
                $arrayOdds[] = $odds;
            }else{
                $odds = $n/($y+$n);
                $arrayOdds[] = $odds;
            }
            $ch = $gamble->pivot->check;
            if($now->gt($gamble->deadline) && $ch==0){
                $answer = $gamble->answers()->first();
                if($gamble->answers()->exists()){
                    if($uc == $answer->content){
                        $gamble->pivot->return = $gamble->pivot->point*$sum/$sofy;
                        $user->point += $gamble->pivot->return;
                        $Answer = "Win!";
                        $arrayAnswers[] = $Answer;
                    }else{
                        $gamble->pivot->return = 0;
                        $user->point += $gamble->pivot->return;
                        $Answer = "Lose!";
                        $arrayAnswers[] = $Answer;
                    }
                    $gamble->pivot->check = 1;
                }
            }else{
                $Answer='coming soon..';
                $arrayAnswers[] = $Answer;
            }
        }

        return view('users.show', [
            'user' => $user,
            'odds'=>$arrayOdds,
            'answers'=>$arrayAnswers,
            'now'=>$now,
        ]);
    }
    
    public function charge(Request $request)
    {
        $request->charge = $request->charge + 0;
        $this->validate($request,[
                'charge'=>'required|integer|min:0',
            ]);
        $user = \Auth::user();
        $user->point +=  $request->charge;
        $user->save();
        
        return back();
    }
}
