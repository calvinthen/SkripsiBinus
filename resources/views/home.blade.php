@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"><h3> <strong>Dashboard</strong> </h3></div>

                <div class="card-body" style="background: #C4CAD0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!Auth::guest())
                        @if(Auth::user()->email_verified_at == NULL)
                            Please Verified first

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>

                        @else

                        @if (Auth::user()->game_prefer == "" || Auth::user()->role_game == "" || Auth::user()->ingame_id == "")
                            its seems you still have missing information! <br>
                            Please complete it by clicking this button !<br><br>

                            <a href="{{route('complete_information')}}" class="btn btn-primary">
                                Submit missing information
                            </a>
                        @else

                            <div class="row">
                                <div class="col-md-6" style="text-align: center">
                                    <a href="{{route('user.find_team')}}" class="btn btn-primary">
                                        Find Team
                                    </a>
                                </div>

                                <div class="col-md-6" style="text-align: center">
                                    <a href="{{route('user.list_user')}}" class="btn btn-primary">
                                        Find Player
                                    </a>
                                </div>
                                <br><br><br>

                                <div class="col-md-6" style="text-align: center">
                                    <a href="{{route('home.leaderboard')}}" class="btn btn-primary">
                                        Leaderboard
                                    </a>
                                </div>

                                <div class="col-md-6" style="text-align: center">
                                    <a href="{{route('home.about')}}" class="btn btn-primary">
                                        About Us
                                    </a>
                                </div>
                            </div>

                        @endif

                        @endif

                    @else
                        You are not login or registered yet
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
