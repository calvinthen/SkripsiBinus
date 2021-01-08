@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team Index</strong></h2>
                </div>

                <div class="card-body">

                    @foreach ($team as $teams)
                        <a href="{{route('user.view_selected_team',$teams->id)}}" style="color: black">
                            {{$teams->team_name}}
                        </a>
                        <br>
                    @endforeach

                </div>

            </div>

            @php
                $myTeam = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
            @endphp

            <br>

            @if ($user->team == NULL)
                doesn't find any team best for you ? why dont create a new one !
                <a href="{{route('team.create_team_index')}}" class="btn btn-primary">
                    Create Team
                </a>

            @elseif($user->team != NULL)
                Your Current Team : <strong>{{$myTeam->team_name}}</strong><br>
                <img src="{{url('./images/' . $myTeam->photo_team)}}" width="150px" height="150px">
            @endif



        </div>
    </div>
</div>


@endsection
