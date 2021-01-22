@extends('layouts.app')
<style>
    .friend:hover{
        transform:scale(1.1)
    }

    .own_team:hover{
        transform:scale(1.1)
    }
</style>
@section('content')
<div class="container">

    @php
        $myTeam = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
        $leader = DB::table('users')->where('id','LIKE',$myTeam->leader_id)->first();
        $myMember = DB::table('users')->where('team_id','LIKE',$myTeam->id)->get();
        $countMember = count($myMember);
    @endphp
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team List</strong></h2>
                </div>

                <div class="card-body" >
                    <form action="" method="">
                        <!-- Search form -->
                        <div class="md-form active-cyan-2 mb-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <input class="input" type="text" name="searchName" id="searchName" placeholder="Search team name here" aria-label="Search" style="background: #292e36">
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-customBlack" style="width:100%" type="submit">
                                        Search
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
             @if ($user->team == NULL)
                <div class="row" style="text-align: center">
                    <div class="col-md-12">
                        <a href="{{route('team.create_team_index')}}" class="btn btn-customBlack" style="background:#393e46">
                            Create Your Own Team
                        </a>
                    </div>
                </div>
            @else
                <div class="row" style="width:275px">
                    <a class="nav-link" href="{{route('team.user_team_index')}}" style="width:100%">
                    <div class="card own_team" style="transition:0.5s; width:100%"> 
                        <div class="card-header">
                            <center><h5>{{$myTeam->team_name}}</h5></center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <strong>
                                        Leader : {{$leader->name}}
                                    </strong>
                                    <br>
                                    <strong>{{$countMember}} member(s)</strong>
                                </div>  
                                <div class="col-sm-4">
                                    <img src="{{url('./images/' . $myTeam->photo_team)}}" width="60px" height="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endif
        </div>
    </div>

    @foreach ($team as $teams)
    @php
        $leader = DB::table('users')->where('id','LIKE',$teams->leader_id)->first();
        $member = DB::table('users')->where('team_id','LIKE',$teams->id)->get();
        $countMember = count($member);
    @endphp
        <div class="row" style="margin-top:10px">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <a id="team" href="{{route('user.view_selected_team',$teams->id)}}" style="text-decoration: none; color:#eeeeee;">
                    <div class="card friend" style="transition: .5s">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="{{url('./images/' .  $teams->photo_team)}}" alt="" width="80px" height="80px" style="border-radius:40px">
                                </div>
                                <div class="col-sm-7">
                                    <h5>{{$teams->team_name}}</h5>
                                    <strong>
                                        Leader : {{$leader->name}}

                                    </strong>
                                    <br>
                                    @php
                                        $date = date_create($teams->created_at);
                                    @endphp
                                    <strong>Created on {{date_format($date, "F j, Y")}}</strong>
                                    <br>

                                    <strong>{{$countMember}} member(s)</strong>
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
