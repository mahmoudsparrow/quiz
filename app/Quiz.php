<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Question(){
        return $this->hasMany(Question::class);
    }

    public function studentAnswer(){
        return $this->hasMany(StudentAnswer::class);
    }
}
