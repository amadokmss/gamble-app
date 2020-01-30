<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'gamble_id','user_id'];

    public function gambles()
    {
        return $this->belongsTo(Gamble::class);
    }
    
    public function get_user()
    {
        $user = \App\User::find($this->user_id);
        return $user;
    }
}
