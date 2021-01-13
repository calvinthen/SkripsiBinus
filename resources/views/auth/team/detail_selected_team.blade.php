@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">

                @php
                    $leader = DB::table('users')->where('id','LIKE',$team->leader_id)->first();

                    $member = DB::table('users')->where('team_id','LIKE',$team->id)->get();
                @endphp

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team Detail: {{$team->team_name}}</strong></h2>
                </div>

                <div class="card-body"  style="background: #C4CAD0">

                    <img src="{{url('./images/' . $team->photo_team)}}" width="150px" height="150px"><br>

                    <strong>Leader : </strong> {{$leader->name}}
                    <br><br>
                    <strong>Member</strong><br>
                    @foreach ($member as $members)
                        {{$members->name}}<br>
                    @endforeach


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
                    <br>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
