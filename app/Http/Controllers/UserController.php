<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quiz;
use App\StudentAnswer;
use App\StudentQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // INSTRUCTOR

    public function makeQuiz(){
        $quiz = new Quiz();
        $quiz->user_id = Auth::user()->id;
        $quiz->title = 'quiz'; // will be dynamic but not now
        $quiz->status = 0; // make it default
        $quiz->save();
//        $quizID = $quiz->all()->where('userID', Auth::user()->id)->where('status', 0)->first();
//        return $quizID->id;
        Session::put('quizID', $quiz->id);
        return view('makeQuestion');
    }

    public function endQuiz(){
        $quiz = new Quiz();
        $quiz = $quiz->find(Session::get('quizID'));
        $quiz->status = 1;
        $quiz->update();
        Session::forget('quizID');
        return view('home');
    }

    public function showMakeQuesitionPage(){
        return view('makeQuestion');
    }

    public function makeQuestion(Request $request){
        if($request->isMethod('get')){
            return view('makeQuestion');
        }
        $quizID = Session::get('quizID');
        $question = $request->input('question');
        $answerRb = $request->input('answer');
        $choice1 = $request->input('choice1');
        $choice2 = $request->input('choice2');
        $choice3 = $request->input('choice3');
        $choice4 = $request->input('choice4');

//        echo"<script type='text/javascript'>
//                alert($request->all);
//
//             </script>";
//        if($choice3 == null)
//            return 'null';
        $rightAnswer = substr($answerRb, -1);
//return $rightAnswer;
        $questionModel = new Question();
        $questionModel->quiz_id = $quizID;
//        return $question;
        echo"<script type='text/javascript'>
                alert($question);
                
             </script>";
        $questionModel->question = $question;
        $questionModel->save();
        $questionID = $questionModel->id;

        $choiceArray = Array($choice1, $choice2, $choice3, $choice4);
//        return $choiceArray;


        for ($i = 0; $i < 4; $i++){
            if($choiceArray[$i] == null)
                break;
            $answerModel = new Answer();
            $value = 0;
            if(($rightAnswer - $i) == 1)
                $value = 1;
            $answerModel->question_id = $questionID;
            $answerModel->answer = $choiceArray[$i];
            $answerModel->isRight = $value;
            $answerModel->save();
        }
        return redirect()->route('makeQuestion');
    }

    // STUDENT

    public function showQuiz($quizID){
        Session::has('score') ? Session::forget('score') : null;
        $question = new Question();
        $question = $question->all()->where('quiz_id', $quizID)->first();
//        $quiz = new Quiz();
//        $quiz = $quiz->find($quizID);
        return view('solveQuestion', ['question' => $question]);
    }

    public function showAllQuizzes(){
        $quizzes = new Quiz();
        $quizzes = $quizzes->all();
        return view('quizList', ['quizzes' => $quizzes]);
    }

    public function showQuestion($question_id, $quiz_id){
//        $question = new Question();
        $question = Question::all()->where('id', $question_id)->where('quiz_id', $quiz_id)->first();
//        return $question;
//        $quiz = new Quiz();
//        $quiz = $quiz->find($quizID);
        //return $question;
        if($question == '') {
            $checkQuiz = StudentQuiz::all()->where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id);
            $score = Session::get('score');
            if($checkQuiz == '') {
                $studentQuiz = new StudentQuiz();
                $studentQuiz->user_id = Auth::user()->id;
                $studentQuiz->quiz_id = $quiz_id;
                $studentQuiz->score = $score;
                $studentQuiz->save();
            }
//            echo $score;
//            Session::forget('score');
            $studentAnswer = StudentAnswer::all()->where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id);
            $quiz = Quiz::all()->where('id', $quiz_id);
            return view('congrats', ['studentAnswer' => $studentAnswer, 'quiz' => $quiz, 'score' => $score]);
        }
        return view('solveQuestion', ['question' => $question]);
    }

    public function isRight(Request $request, $question_id, $quiz_id){
        $answerRb = $request->input('dataForm');//return $answerRb;
        $attempts = $request->input('attempts'); //return $answerRb;
//        $answerRb = explode('&', $answerRb);
//        $answerRb = $answerRb[1];
        $answerRb = explode('=', $answerRb);
        $studentAnswer = $answerRb[1];
        //return $studentAnswer;

        //$studentAnswer = substr($answerRb, -1);
        //return $studentAnswer;
//        return ['msg' => 'false', 'next_url' => $att];
        $answer = Answer::all()->where('question_id', $question_id)->where('answer', $studentAnswer)->where('isRight', 1);
//        return $answer;
        if ($answer != '[]'){
            $score = 0;
            Session::has('score') ? $score = Session::get('score') : Session::put('score', $score);
            if($attempts == 2){
                $score += 2;
                Session::put('score', $score);
            }elseif ($attempts == 1){
                $score++;
                Session::put('score', $score);
            }
            $isThere = StudentAnswer::all()->where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id)->where('question_id', $question_id);
            if ($isThere == '[]') {
                $studentAnswerModel = new StudentAnswer();
                $studentAnswerModel->user_id = Auth::user()->id;
                $studentAnswerModel->quiz_id = $quiz_id;
                $studentAnswerModel->question_id = $question_id;
                $studentAnswerModel->studentAnswer = $studentAnswer;
                $studentAnswerModel->isRight = 1;
                $studentAnswerModel->save();
            }
            $url = route('showQuestion', ['question_id' => ++$question_id, 'quiz_id' => $quiz_id]);
            return ['msg' => 'true', 'next_url' => $url];
        }else{
            if($attempts == 0){
                $studentAnswerModel = new StudentAnswer();
                $studentAnswerModel->user_id = Auth::user()->id;
                $studentAnswerModel->quiz_id = $quiz_id;
                $studentAnswerModel->question_id = $question_id;
                $studentAnswerModel->studentAnswer = $studentAnswer;
                $studentAnswerModel->isRight = 0;
                $studentAnswerModel->save();
                $url = route('showQuestion', ['question_id' => ++$question_id, 'quiz_id' => $quiz_id]);
                return ['msg' => 'true', 'next_url' => $url];
            }
        }
            //return redirect()->route('showQuestion', ['question_id' => ++$question_id, 'quiz_id' => $quiz_id]);
        return ['msg' => 'false', 'attempts_left' => --$attempts];
//        return $answer[$studentAnswer-1]->isRight;
//
//        return $rightAnswer;
    }



}
