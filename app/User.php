<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function gambles()
    {
        return $this->hasMany(Gamble::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function get_gambles()
    {
        return $this->belongsToMany(Gamble::class,'user_gamble','user_id','gamble_id')->withPivot('choice','return','point','check');
    }
    
    public function is_partaking($gambleId)
    {
        return $this->get_gambles()->where('gamble_id',$gambleId)->exists();
    }
    
    public function partakes($gambleId,$choice,$money)
    {
        $exist = $this->is_partaking($gambleId);
        
        if($exist){
            return false;
        }else{
            $this->get_gambles()->attach($gambleId,['choice'=>$choice,'point'=>$money]);
            $gamble = Gamble::find($gambleId);
            $gamble->people = $gamble->people+1;
            $gamble->save();
        }
    }
    
}
