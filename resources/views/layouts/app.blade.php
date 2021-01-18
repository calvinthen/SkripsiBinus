<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head style="background-color: #053163">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- BUAT ICON TITLE -->
    <link rel="icon" href="{{ URL::asset('/images/user.jpg') }}" type="image/x-icon"/>
    <!-- -->

    <title> Playmaker</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/css_halaman_utama/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('css/css_halaman_utama/custom.scss')}}" rel="stylesheet">

    <style>
        body {margin:0;}

        main{
            padding: 16px;
            margin-top: 70px;
        }

        .dropdown-menu{
            z-index: 5;
        }

    </style>
</head>

<body style="background-color: #222831" onload="runScriptOnload()">
    <div id="app">
          <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

            <div class="container">

                {{-- INITIALIAZE VARIABLE --}}
                @php
                    if(Auth::guest())
                    {
                        $userRole = 'none';
                    }
                    else
                    {
                        $userRole = Auth::user()->role;

                        $user_id = Auth::user()->id;
                        $not_readed = 'not_readed';
                        $mail = DB::select(DB::raw("select * from inboxes where receiver_id LIKE '$user_id' and  mail_readed LIKE '$not_readed'"));
                        $totalEmail = count($mail);
                    }

                @endphp

                <a class="navbar-brand" href="{{ url('/') }}" style="color: white">
                    <img class ="rounded mx-auto d-block" src="{{ asset('images/asset/logo.png')}}" alt="" height="35px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  class="nav-link" href="{{ route('register') }}">{{ __('Create an account') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background: #C4CAD0;">
                                    <a class="dropdown-item" href={{route('profile.index',Auth::user()->id)}}>
                                        Profile
                                    </a>

                                    @if (Auth::user()->team == NULL)

                                    @else
                                    <a href="{{route('team.user_team_index')}}" class="dropdown-item">
                                        Team
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="{{route('user.friendlist')}}">
                                        Friend
                                    </a>

                                    <a class="dropdown-item notification" href="{{route('user.inbox')}}">
                                        Inbox
                                        @if ($mail != NULL)
                                        <span class="badge" style="background: red"> {{$totalEmail}}</span>
                                        @endif
                                    </a>


                                    @if($userRole == 'admin')
                                        <a class="dropdown-item" href="{{route('admin.index')}}">
                                            Admin tools
                                        </a>
                                    @endif

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

            @include('layouts.footer')

        </main>

    </div>

    <script>
        function runScriptOnload(){
            //scroll chat
            var elmnt = document.getElementById("chat");
            elmnt.scrollTop = elmnt.scrollHeight;
       }
   </script>

</body>

</html>


@section('css_notif_design')

@endsection
