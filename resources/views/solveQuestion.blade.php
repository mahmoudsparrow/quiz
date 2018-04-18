@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $question->question }}</div>

                <div class="card-body">
                    <form id="answerForm" method="get" action="{{ route('isRight', ['question_id' => $question->id, 'quiz_id' => $question->quiz_id]) }}">

                        @php
                            $i = 1
                        @endphp
                        @foreach($question->answer as $answer)
                            <div>

                                <input type="radio" name="answer" value="{{ $answer->answer }}" required/> <label >{{ $answer->answer }}</label>
                                {{ $answer->isRight }}
                                @php
                                    $i++
                                @endphp
                            </div>
                        @endforeach
                            <input id="submitAnswer" type="submit" class="btn btn-info" value="submit"/>
                    </form>

            {{--{{ $questions }}<br>--}}
                    {{--@foreach($questions as $question)--}}
                        {{--{{ $question->id }}--}}
                        {{--<form method="post" action="{{ route('solveQuestion', ['question_id' => $question->id]) }}">--}}
                            {{--{{ $question->question }}<br>--}}
                            {{--@php--}}
                                {{--$i = 1--}}
                            {{--@endphp--}}
                            {{--@foreach($question->answer as $answer)--}}
                                {{--<input type="radio" name="answer" value="answer{{ $i }}"/>{{ $answer->answer }}--}}
                                {{--@php--}}
                                    {{--$i++--}}
                                {{--@endphp--}}
                            {{--@endforeach--}}
                            {{--<br>--}}
                        {{--</form>--}}
                    {{--@endforeach--}}

                </div>
                <div class="card-footer">
                    <label>Number of attempts: </label><p id="no_attempts">2/2</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

