@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Congrats... Your score is: {{ $score }}</h3></div>

                <div class="card-body">
                    @foreach($quiz as $qz)
                        <div class="list-group">
                        @foreach($qz->question as $question)

                            <div class="list-group-item">
                                <h4 class="list-group-item-heading">
                                    {{ $question->question }}
                                    {{--<{{ $question->studentAnswer->first() }}>--}}
                                </h4>
                                @if($question->studentAnswer->where('question_id', $question->id)->first()->isRight)
                                    <p class="text-success">{{ $question->studentAnswer->where('question_id', $question->id)->first()->studentAnswer }}</p>
                                @else
                                    <p class="text-danger">{{ $question->studentAnswer->where('question_id', $question->id)->first()->studentAnswer }}</p>
                                @endif
                                @foreach($question->answer as $answer)

                                    @if($answer->isRight)
                                        <div class="list-group-item-text">
                                            <p class="text-success">{{ $answer->answer }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <p id="no_attempts"></p>
                    <input type="button" class="btn btn-primary" value="Next"/>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

