@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <h2><a href="{{route('makeQuiz')}}">Make Quiz From Here</a> </h2>
                <h2><a href="{{route('showAllQuizzes')}}">Show Quizzes From Here</a> </h2>
            </div>
        </div>
    </div>
</div>
@endsection
