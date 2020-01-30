<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['content', 'gamble_id'];

    public function gambles()
    {
        return $this->belongsTo(Gamble::class);
    }
}
