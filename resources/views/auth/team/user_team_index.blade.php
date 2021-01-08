@extends('layouts.app')

@section('content')
<div class="container">

    <!-- AMBIL MEMBER TEAM-->
    @php
        $leader = DB::table('users')->where('id','LIKE',$team->leader_id)->first();

        $member = DB::table('users')->where('team_id','LIKE',$team->id)->get();

        // if($team->first_member_id != NULL)
        // {
        //     $first_member = DB::table('users')->where('unique_id','LIKE',$team->first_member_id)->first();
        // }

        // if($team->second_member_id != NULL)
        // {
        //     $second_member = DB::table('users')->where('unique_id','LIKE',$team->second_member_id)->first();
        // }

        // if($team->third_member_id != NULL)
        // {
        //     $third_member = DB::table('users')->where('unique_id','LIKE',$team->third_member_id)->first();
        // }

        // if($team->forth_member_id != NULL)
        // {
        //     $forth_member = DB::table('users')->where('unique_id','LIKE',$team->forth_member_id)->first();
        // }
    @endphp

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center">
                <h2><strong> Team : {{$team->team_name}}</strong></h2>
                </div>

                <div class="card-body">

                <img src="{{url('./images/' . $team->photo_team)}}" alt="" width="100px" height="100px">
                <br>

                    Leader : {{$leader->name}}
                    <br>

                    <strong>Member</strong><br>

                    @foreach ($member as $members)

                        @if ($members->name == $leader->name)
                            @continue
                        @endif

                        <a href="{{route('team.member_team_detail',$members->id)}}" style="color: black">
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


                    {{-- @if( Auth::user()->name == $leader->name)
                        @if ($totalMemberKosong == 4)
                            You don't have any member yet ! <br>
                            Why dont try to find one ?
                            <br> --}}


                        <a href="{{route('team.find_member')}}" class="btn btn-primary">
                            Find member
                        </a>

                        {{-- @elseif($totalMemberKosong > 0 && $totalMemberKosong <= 3)
                            There is still a slot member missing !
                            <br>
                            Try invite more member!
                            <br>
                            <br> --}}

                        <a href="" class="btn btn-danger">
                            Quit Team
                        </a>

                        {{-- @endif
                    @endif --}}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
