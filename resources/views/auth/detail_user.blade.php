@extends('layouts.app')
<style>
    #edit{
        color: #eeeeee;
    }

    #edit:hover{
        color: #cccccc ;
    }

    .a{
        color: #eeeeee !important;
        transition: 0.5s;
    }

    .a:hover{
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
    @php
        $flagFriendlistOrNot = DB::table('friends')->where(['id_user' => Auth::user()->id , 'id_user2' => $user->id])->count();
        $flagFriendlistOrNot2 = DB::table('friends')->where(['id_user' => $user->id , 'id_user2' => Auth::user()->id])->count();

        $ratingTable = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->get();
        $totalReviewer = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->count();

        $scoreRatingUser = 0;

        foreach ($ratingTable as $ratingTables){
            $scoreRatingUser += $ratingTables->score;
        }

        if($totalReviewer != 0)
        {
            $averageScoreRating = $scoreRatingUser / $totalReviewer;
        }

        $reviews = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->orderBy('created_at')->paginate(5);

        if($user->team_id != NULL)
        {
            $team = DB::table('teams')->where('id','LIKE',$user->team_id)->first();
            $teamMembers = DB::table('users')->where('team', 'LIKE', $team->team_name)->get();
        }
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h2><strong> Detail User : {{$user->name}}</strong></h2>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-fluid" src="{{url('./images/' . $user->photo_profile)}}" alt="" width="150px" height="150px">
                        </div>
                        <div class="col-sm-7">
                            <h3>{{$user->name}}</h3>
                            @php
                                $date = date_create($user->created_at);
                                $totalReviewBaik = DB::table('reviews')->where(['receiver_id' => $user->id , 'like_or_dislike' => 'like'])->count();
                                $totalReviewBuruk = DB::table('reviews')->where(['receiver_id' => $user->id , 'like_or_dislike' => 'dislike'])->count();
                            @endphp
                            <h5>Joined since {{date_format($date, "F j, Y")}}</h5>
                            <h5>Reviews</h5>

                            <div class="row">
                                <div class="col-sm-6">
                                    <i class="fa fa-thumbs-up" style="font-size: 30px;color: greenyellow;"></i> <h3> {{$totalReviewBaik}}</h3>
                                </div>

                                <div class="col-sm-6">
                                    <i class="fa fa-thumbs-down" style="font-size: 30px;color: red;"></i> <h3> {{$totalReviewBuruk}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-customBlack" data-toggle="modal" data-target="#removeFriendModal" style="color:red; width:45%">
                                <i class="fa fa-remove" aria-hidden="true"></i>
                            </a>
                            <button class="btn btn-customBlack" data-toggle="modal" data-target="#exampleModal" style="color:orange; width:45%">
                                <i class="fa fa-flag" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if($flagFriendlistOrNot == 0 && $flagFriendlistOrNot2 == 0)
                                <a href="{{route('user.send_friend_request',$user->id)}}">
                                    <Button class="btn btn-customBlack float-right">
                                        Add Friend
                                    </Button>
                                </a>
                            @else
                                <a href="{{route('user.chat_friend_index',$user->id)}}" class="btn btn-customBlack float-right">
                                    Send Message!
                                </a>
                            @endif

                            <!-- Modal REMOVE FRIEND-->
                            <div class="modal fade" id="removeFriendModal" tabindex="-1" role="dialog" aria-labelledby="removeFriendModal" aria-hidden="true" style="color: black">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content" style="background: #292e36; color: #eeeeee">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="removeFriendModal" >Remove Friend {{$user->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure want to delete <strong>{{$user->name}}</strong> from your friendlist?  <br> <br>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                        <a href="{{route('user.remove_friend',$user->id)}}" class="btn btn-danger">
                                            Remove Friend
                                        </a>
                                    </div>

                                </div>
                                </div>
                            </div>

                            <form action="{{route('user.report_player',$user->id)}}" method="GET">
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="background: #292e36; color: #eeeeee">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Report {{$user->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body" style="text-align: center">
                                        <strong>Choose your reason :</strong>
                                        <br>
                                            @php
                                                $report_reason = DB::table('report_reasons')->get();
                                            @endphp

                                            <div class="form-group">
                                                <select class="form-control" id="isiReport" name="isiReport">
                                                    @foreach ($report_reason as $report_reasons)
                                                        <option value="{{$report_reasons->reason}}">{{$report_reasons->reason}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <strong> Detail reason :</strong>
                                            <br>

                                            <textarea name="detail" id="detail" cols="50" rows="5" placeholder="Input your report detail" required></textarea>


                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">
                                            Report!
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL -->
                            </form>

                        </div>
                    </div>
                        <br>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('status_friendlist'))
                            <div class="alert alert-danger">
                                {{ session('status_friendlist') }}
                            </div>
                        @endif

                        @if (session('status_report'))
                            <div class="alert alert-success">
                                {{ session('status_report') }}
                            </div>
                        @endif
                </div>
            </div>

        </div>
    </div>

        <div class="row" style="margin-top:10px">
        <div class="col-2"></div>
        <div class="col-sm-8">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Overview')">Overview</button>
                <button class="tablinks" onclick="openCity(event, 'Team')" style="border-left: 1px black solid">Team</button>
            </div>

            <div id="Team" class="tabcontent">
                @if ($user->team_id == NULL)
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
                                <a class="a" href="{{route('team.user_team_index')}}" style="text-decoration: none !important; margin-left:10px">
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
                                                    <a class="a" href="{{route('user.detail',$teamMember->id)}}" style="text-decoration: none; width: 50%">
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
                            @if ($user->game_prefer == "csgo")
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
                            {{$user->role_game}}
                        </strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <h5>Total points</h5>
                    </div>
                    <div class="col-sm-1 titik2">
                        :
                    </div>
                    <div class="col-sm-8">
                        <strong>
                            {{$user->point}} of {{$totalReviewer}} review(s)
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
                                <a class="a" href="{{route('user.detail',$orangYangReview->id)}}" style="text-decoration:none"><strong><b>{{$orangYangReview->name}}</b></strong></a>
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

                                    @if( $flagFriendlistOrNot == 0 && $flagFriendlistOrNot2 == 0)

                                    @elseif ($pernahVoting == 1 )
                                        <strong>You already voted for this review !</strong>
                                    @else
                                    <a href="{{route('review.upvote',$review->id)}}" class="btn btn-customBlack float-right" style="color: lime; width: 40%; margin-left: 10px">
                                        <i class="fa fa-arrow-up" aria-hidden="true" style="color: lime"></i>
                                    </a>

                                    <a href="{{route('review.downvote',$review->id)}}" class="btn btn-customBlack float-right" style="width: 40%; margin-left: 10px">
                                        <i class="fa fa-arrow-down" aria-hidden="true" style="color: red"></i>
                                    </a>
                                    @endif
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
