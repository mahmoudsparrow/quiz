<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function Quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }

    public function StudentAnswer(){
        return $this->hasMany(StudentAnswer::class);
    }
}
