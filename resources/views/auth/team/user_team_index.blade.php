@extends('layouts.app')

@section('content')
<div class="container">

    <!-- AMBIL MEMBER TEAM-->
    @php
        $leader = DB::table('users')->where('id','LIKE',$team->leader_id)->first();

        $member = DB::table('users')->where('team_id','LIKE',$team->id)->get();

    @endphp

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                <h2><strong> Team : {{$team->team_name}}</strong></h2>
                </div>

                <div class="card-body">

                <img src="{{url('./images/' . $team->photo_team)}}" alt="" width="100px" height="100px">
                <br>

                    Leader :
                    <a href="{{route('team.member_team_detail',$leader->id)}}" style="color: white">
                        {{$leader->name}}
                    </a>
                    <br>

                    <strong>Member</strong><br>

                    @foreach ($member as $members)

                        @if ($members->name == $leader->name)
                            @continue
                        @endif

                        <a href="{{route('team.member_team_detail',$members->id)}}" style="color: white">
                            {{$members->name}}
                        </a>
                        <br>
                    @endforeach
                        <br><br>


                        <a href="{{route('team.chat_index',$team->id)}}" class="btn btn-success">
                            Team chat
                        </a>

                    @if(Auth::user()->name  != $leader->name)

                        <a href="{{route('user.quit_team')}}" class="btn btn-danger">
                            Quit Team
                        </a>
                    @endif


                    @if( Auth::user()->name == $leader->name)

                        <a href="{{route('team.find_member')}}" class="btn btn-primary">
                            Find member
                        </a>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
