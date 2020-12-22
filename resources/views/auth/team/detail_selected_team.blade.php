@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team Detail: {{$team->team_name}}</strong></h2>
                </div>

                <div class="card-body">

                    <img src="{{url('./images/' . $team->photo_team)}}" width="150px" height="150px">

                    Leader ID : {{$team->leader_id}}
                    <br><br>


                    @if (Auth::user()->team_id == NULL)

                    <div class="row">
                        <div class="col-md-12" style="text-align: center">

                            <a href="{{route('user.request_join_team',$team->id)}}">
                                <button class="btn btn-primary">
                                    Request Join Team
                                </button>
                            </a>

                        </div>
                    </div>

                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
@endsection
