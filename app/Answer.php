<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function Question(){
        $this->belongsTo(Question::class);
    }
}
