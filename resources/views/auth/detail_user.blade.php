@extends('layouts.app')

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

        $reviews = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->paginate(5);


    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h2><strong> Detail User : {{$user->name}}</strong></h2>
                </div>
                <div class="card-body" >

                    <img src="{{url('./images/' . $user->photo_profile)}}" alt="" width="150px" height="150px"><br><br>

                    <strong>Team : </strong> {{$user->team}}<br>

                    <strong>Role : </strong> {{$user->role_game}}<br>

                    <strong>Total Reviewer : </strong> {{$totalReviewer}}<br>

                    <strong>Point : </strong> {{$user->point}} <br>

                    @if ($totalReviewer != 0)
                        <strong>Average Rating : </strong> {{$averageScoreRating}}
                    @endif


                    <div class="row">
                        <div class="col-md-12" style="text-align: center">


                            @if($flagFriendlistOrNot == 0 && $flagFriendlistOrNot2 == 0)
                                <a href="{{route('user.send_friend_request',$user->id)}}">
                                    <Button class="btn btn-primary">
                                        Add Friend
                                    </Button>
                                </a>
                            @else
                                <a href="{{route('user.chat_friend_index',$user->id)}}" class="btn btn-success">
                                    Send Chat!
                                </a>

                                <br>
                                <br>

                                <a class="btn btn-warning" data-toggle="modal" data-target="#removeFriendModal">
                                    Remove Friend
                                </a>

                                <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                    Report!
                                </button>

                            @endif

                            <!-- Modal REMOVE FRIEND-->
                            <div class="modal fade" id="removeFriendModal" tabindex="-1" role="dialog" aria-labelledby="removeFriendModal" aria-hidden="true" style="color: black">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
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
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Report {{$user->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
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
            <br>


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



                                @if( $flagFriendlistOrNot == 0 && $flagFriendlistOrNot2 == 0)

                                @elseif ($pernahVoting == 1 )
                                    <strong>You already vote for this review !</strong>
                                @else
                                <a href="{{route('review.upvote',$review->id)}}" class="btn btn-customBlack float-right" style="color: lime; width: 40%; margin-left: 10px">
                                    <i class="fa fa-arrow-up" aria-hidden="true" style="color: lime"></i>
                                </a>

                                <a href="{{route('review.downvote',$review->id)}}" class="btn btn-customBlack float-right" style="width: 40%; margin-left: 10px">
                                    <i class="fa fa-arrow-up" aria-hidden="true" style="color: red"></i>
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
    </div>
</div>
@endsection
