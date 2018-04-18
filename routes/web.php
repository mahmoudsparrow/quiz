<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Quiz
Route::get('/make/quiz', 'UserController@makeQuiz')->name('makeQuiz');
Route::get('/show/quiz/{quizID}', 'UserController@showQuiz')->name('showQuiz');
Route::get('/show/all/quizzes', 'UserController@showAllQuizzes')->name('showAllQuizzes');
Route::get('/end/quiz', 'UserController@endQuiz')->name('endQuiz');
// Question
Route::get('/make/question', 'UserController@makeQuestion')->name('makeQuestion');
Route::post('/make/question', 'UserController@makeQuestion')->name('makeQuestion');
Route::get('/show/question/{question_id}/quiz/{quiz_id}', 'UserController@showQuestion')->name('showQuestion');
Route::get('/solve/question/{question_id}/quiz/{quiz_id}', 'UserController@isRight')->name('isRight');

//Route::get('/congrats', 'UserController@congrats')->name('congrats');
