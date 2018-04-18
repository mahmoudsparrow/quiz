@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form method="post" action="{{ route('makeQuestion') }}">
                        {{ csrf_field() }}
                        <textarea id="textareaa" name="question" placeholder="Question Description" maxlength="1000" required></textarea>
                        {{--<br><em id="chars">0/1000</em><br>--}}
                        <br>
                        <input type="radio" name="answer" value="answer1" checked/><input type="text" name="choice1"/><br>
                        <input type="radio" name="answer" value="answer2"/><input type="text" name="choice2"/><br>
                        <div class="extraAnswers"></div>
                        <input type="submit" class="btn btn-info"/><input type="button" class="btn btn-primary" value="add answer" id="extraAnswersBtn"/>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('endQuiz') }}" class="btn btn-primary">End quiz</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

