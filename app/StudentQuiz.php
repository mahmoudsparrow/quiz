<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    public function Question(){
        return $this->hasMany(Question::class);
    }

    public function StudentAnswer(){
        return $this->hasMany(StudentAnswer::class);
    }

    public function Quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
