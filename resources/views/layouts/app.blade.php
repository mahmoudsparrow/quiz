<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var i = 0;
            $('#extraAnswersBtn').on('click', function (e) {
                e.preventDefault();

                if(i < 2) {
                    $('.extraAnswers').append('<input type="radio" name="answer" value="answer'+(i+3)+'"/><input type="text" name="choice'+(i+3)+'"/><br>');
                    i++;
                    if(i === 2)
                        $('#extraAnswersBtn').prop('disabled', true);
                }else
                    $('#extraAnswersBtn').prop('disabled', true);
            });

            var answerAttempts = 2;
            $('#answerForm').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var dataf = $(this).serialize();

                console.log(url);
                $.ajax({
                    method:'GET',
                    url: url,
                    data : {dataForm: dataf, attempts: answerAttempts}
                }).done(function (msg) {
                    console.log(msg);
                    var next_url = msg.next_url;
                    if(msg.msg === 'true') {
                        location = msg.next_url
                    }if(msg.msg === 'false') {
                        console.log(msg.attempts_left);
                        answerAttempts--;
                        $('#no_attempts').html(answerAttempts+'/2');
                        if(answerAttempts == 0)
                            $('#submitAnswer').val('Next')
                    }
                });
            });

//            $('#answerForm').on('click', function (e) {
//                e.preventDefault();
//                console.log($(e.target.parentNode).attr('href'));
////                var url = $(this).attr('href');
////                $.ajax({
////                    method:'GET',
////                    url: url
////                }).done(function (msg) {
//////                    console.log(msg);
////                    if(msg === 'true') {
////                        console.log('askndk');
////                    }if(msg === "false") {
////                        alert("kjdf");
////                    }else {
////                        console.log(url);
////                    }
////                });
//            });
        });
    </script>
</body>
</html>
