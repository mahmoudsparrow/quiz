@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach($quizzes as $quiz)
                        take <a href="{{ route('showQuiz', ['quizID' => $quiz->id]) }}">{{ $quiz->title }}</a><hr>
                    @endforeach
                </div>
                <div class="card-footer">
                    <input type="button" class="btn btn-primary" value="Next"/>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

