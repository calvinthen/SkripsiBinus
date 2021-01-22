@extends('layouts.app')
<style>
    #leader:hover{
        color: #cccccc !important;
    }

    .teamMember:hover{
        transform: scale(1.1);
    }
</style>

@section('content')
<div class="container">

    <!-- AMBIL MEMBER TEAM-->
    @php
        $leader = DB::table('users')->where('id','LIKE',$team->leader_id)->first();
        $member = DB::table('users')->where('team_id','LIKE',$team->id)->get();
        $countMember = count($member);
    @endphp

    <div class="row justify-content-center">
        <div class="col-sm-2"></div>
        
        <div class="col-sm-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                <h2><strong> Team : {{$team->team_name}}</strong></h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{url('./images/' . $team->photo_team)}}" alt="" style="border-radius:20px" width="150px" height="150px">
                        </div>
                        <div class="col-sm-8">
                            <h5>
                                Leader :
                                <a id="leader" href="{{route('team.member_team_detail',$leader->id)}}" style="transition: .5s; color: #eeeeee; text-decoration: none">
                                    {{$leader->name}}
                                </a>
                            </h5>
                            <h5></h5>
                            @php
                                $date = date_create($team->created_at);
                            @endphp
                            <h5>Created on {{date_format($date, "F j, Y")}}</h5>
                            <strong>{{$countMember}} member(s)</strong>
                        </div>
                    </div>

                    <a href="{{route('team.chat_index',$team->id)}}" class="btn btn-customBlack float-right" style="margin-left:10px">
                        Team Message
                    </a>

                    @if(Auth::user()->name  != $leader->name)
                        <a href="{{route('user.quit_team')}}" class="btn btn-customBlack float-right" style="margin-left:10px">
                            Quit Team
                        </a>
                    @endif

                    @if( Auth::user()->name == $leader->name)

                        <a href="{{route('team.find_member')}}" class="btn btn-customBlack float-right" style="margin-left:10px">
                            Find member
                        </a>
                    @endif

                </div>

            </div>
        </div>

        <div class="col-sm-2">
            <a class="btn btn-customBlack" href="{{route('user.find_team')}}" style="text-decoration: none; width:100%; background:#393e46">
                Team List
            </a>
        </div>
    </div>

    @foreach ($member as $members)

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <a id="friend" href="{{route('team.member_team_detail',$members->id)}}" style="text-decoration: none; color:#eeeeee;">
                <div class="card teamMember" style="transition: .5s; margin-top:10px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="{{url('./images/' .  $members->photo_profile)}}" alt="" width="80px" height="80px" style="border-radius:40px">
                            </div>
                            <div class="col-sm-7">
                                <h5>{{$members->name}}</h5>
                                Prefered Game: {{$members->game_prefer}}<br>
                                Role: {{$members->role_game}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-2"></div>
    </div>
    @endforeach

</div>
@endsection
