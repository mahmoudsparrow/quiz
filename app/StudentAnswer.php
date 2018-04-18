<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    public function Quiz(){
        return $this->belongsTo(StudentQuiz::class, 'quiz_id');
    }

    public function Question(){
        $this->belongsTo(Question::class, 'question_id');
    }
}
