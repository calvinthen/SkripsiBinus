@extends('layouts.app')
@php
    if(Auth::user()->team_id != NULL)
    {
        $team = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
        $teamMembers = DB::table('users')->where('team', 'LIKE', $team->team_name)->get();
    }

    $reviews = DB::table('reviews')->where('receiver_id', 'LIKE', Auth::user()->id)->get();

@endphp
<style>
    #edit{
        color: #eeeeee;
    }

    #edit:hover{
        color: #cccccc ;
    }

    a{
        color: #eeeeee !important;
        transition: 0.5s;
    }

    a:hover{
        color: #cccccc !important;
    }
    #team_foto{
        transition: 0.5s;
    }
    #team_foto:hover{
        scale:
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 30px;
        right: 0;
        height: 150px;
        width: 150px;
        opacity: 0;
        transition: .5s ease;
        background-color: black;
    }

    .forImg:hover .overlay {
        opacity: 50%;
    }

    .text {
        color: white;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }


</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:100%; margin-top:5px;">
                <div class="card-header" style="text-align: center"> <h3><strong>Profile</strong></h3></div>
                <div class="card-body">
                    @foreach ($user as $users)
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-fluid" src="{{url('./images/' . $users->photo_profile)}}" alt="" width="150px" height="150px">
                        </div>
                        <div class="col-sm-7">
                            <h3>{{$users->name}}</h3>
                            @php
                                $date = date_create($users->created_at);
                            @endphp
                            <h5>Joined since {{date_format($date, "F j, Y")}}</h5>
                            <h5></h5>
                        </div>
                        <div class="col-sm-2">
                            <a id="edit" class="float-right" href="{{route('profile.edit')}}"> <i class="fa fa-cog" style="font-size: 30px; transition: 0.5s" ></i> </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
                        @if (session('status_team'))
                            <div class="alert alert-success">
                                {{ session('status_team_user') }}
                            </div>
                        @endif
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-2"></div>
        <div class="col-sm-8">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Overview')">Overview</button>
                <button class="tablinks" onclick="openCity(event, 'Team')">Team</button>
            </div>

            <div id="Team" class="tabcontent">
                @if (Auth::user()->team_id == NULL)
                    <h3>You are not in any team</h3>
                    <a class="btn btn-customWhite" href="{{route('team.create_team_index')}}" style="text-decoration: none;">
                        Create Team
                    </a>
                    <a class="btn btn-customBlack" href="{{route('user.find_team')}}" style="text-decoration: none;">
                        Find Team
                    </a>
                @else
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="container forImg">
                                <a href="{{route('team.user_team_index')}}">
                                    <img id="team_foto" class="float-left" src="{{url('./images/' . $team->photo_team)}}" width="150px" height="150px">
                                    <div class="overlay">
                                        <div class="text">CHECK DETAILS</div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <a href="{{route('team.user_team_index')}}" style="text-decoration: none !important; margin-left:10px">
                                    <h3>
                                        {{$team->team_name}}
                                    </h3>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <strong>Member:</strong>
                                    <strong>
                                        <div class="col-sm-10">
                                            @foreach ($teamMembers as $teamMember)
                                                <b>
                                                    <a href="{{route('user.detail',$teamMember->id)}}" style="text-decoration: none; width: 50%">
                                                        {{$teamMember->name}}
                                                    </a>
                                                </b>
                                                <br>
                                            @endforeach
                                        </div>
                                    </strong>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>

            <div id="Overview" class="tabcontent">
                <div class="row">
                    <div class="col-sm-3">
                        <h5>Prefered Game</h5>
                    </div>
                    <div class="col-sm-1 titik2">
                        :
                    </div>
                    <div class="col-sm-8">
                        <strong>
                            @if (Auth::user()->game_prefer == "csgo")
                                Counter Strike: Global Offensive
                            @else
                                Defense of The Ancients
                            @endif
                        </strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <h5>Role</h5>
                    </div>
                    <div class="col-sm-1 titik2">
                        :
                    </div>
                    <div class="col-sm-8">
                        <strong>
                            {{Auth::user()->role_game}}
                        </strong>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-2"></div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            @foreach ($reviews as $review)
                @php
                    $orangYangReview = DB::table('users')->where('id','LIKE',$review->reviewer_id)->first();

                    $totalUpvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'upvote' => 1])->count();
                    $totalDownvote = DB::table('review_votes')->where(['review_id'=>$review->id, 'downvote' => 1])->count();

                    $voting = DB::table('review_votes')->where('review_id','LIKE',$review->id)->get();
                    $pernahVoting = 0;
                    foreach($voting as $votings)
                    {
                        if(Auth::user()->id == $votings->user_id)
                        {
                            $pernahVoting = 1;
                        }
                    }
                @endphp
                <div class="card" style="width:100%; margin-top:5px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <img class="img-fluid" src="{{url('./images/' . $orangYangReview->photo_profile)}}" style="max-width:50px; height:auto; border: 1px solid #222831; border-radius: 25px;">
                            </div>

                            <div class="col-sm-5">
                                {{-- HREF KE ORANG YANG DIREVIEW --}}
                                <a href="{{route('user.detail',$orangYangReview->id)}}" style="text-decoration:none"><strong><b>{{$orangYangReview->name}}</b></strong></a>
                            </div>

                            <div class="col-sm-3">
                                <div class="row">
                                    @if ($review->like_or_dislike == "like")
                                        <i class="fa fa-thumbs-up float-right" style="font-size: 30px;color: greenyellow; margin-left:10px"></i>
                                    @elseif($review->like_or_dislike == "dislike")
                                        <i class="fa fa-thumbs-down float-right" style="font-size: 30px;color: red; margin-left:10px"></i>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-3" style="margin-top:10px">
                                <div class="row">
                                    {{-- TOMBOL UPVOTE DAN DOWNVOTE --}}
                                    {{-- TOLONG DINOTE KALO UDAH PERNAH NGE UPVOTE BERARTI DIA GABISA UPVOTE LAGI, BEGITU JUGA SEBALIKNYA--}}

                                    {{-- <a href="{{route('review.upvote',$review->id)}}" class="btn btn-customBlack float-right" style="color: lime; width: 40%; margin-left: 10px">
                                        <i class="fa fa-arrow-up" aria-hidden="true" style="color: lime"></i>
                                    </a>

                                    <a href="{{route('review.downvote',$review->id)}}" class="btn btn-customBlack float-right" style="width: 40%; margin-left: 10px">
                                        <i class="fa fa-arrow-up" aria-hidden="true" style="color: red"></i>
                                    </a> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$review->body}}
                    </div>
                </div>
                <br>
            @endforeach


        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
<script>
    function openCity(evt, currTab) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(currTab).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>

@endsection

