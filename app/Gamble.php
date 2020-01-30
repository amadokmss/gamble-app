<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamble extends Model
{
    protected $fillable = ['title','content','minpoint','deadline','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    
    public function members()
    {
        return $this->belongsToMany(User::class,'user_gamble','gamble_id','user_id')->withPivot('choice','point','return');
    }
}
