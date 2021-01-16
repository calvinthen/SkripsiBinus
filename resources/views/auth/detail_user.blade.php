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

        $review = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->paginate(5);


    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center">
                    <h2><strong> Detail User : {{$user->name}}</strong></h2>
                </div>
                <div class="card-body" style="background: #C4CAD0">

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
                            <div class="modal fade" id="removeFriendModal" tabindex="-1" role="dialog" aria-labelledby="removeFriendModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="removeFriendModal">Remove Friend {{$user->name}}</h5>
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
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            @foreach ($review as $reviews)
                @php
                    $orangYangReview = DB::table('users')->where('id','LIKE',$reviews->reviewer_id)->first();
                    $totalUpvote = DB::table('review_votes')->where(['review_id'=>$reviews->id, 'upvote' => 1])->count();
                    $totalDownvote = DB::table('review_votes')->where(['review_id'=>$reviews->id, 'downvote' => 1])->count();

                    $voting = DB::table('review_votes')->where('review_id','LIKE',$reviews->id)->get();
                    $pernahVoting = 0;
                    foreach($voting as $votings)
                    {
                        if(Auth::user()->id == $votings->user_id)
                        {
                            $pernahVoting = 1;
                        }
                    }
                @endphp
                <div class="card">
                    <div class="card-header">
                        {{$orangYangReview->name}} Just review {{$user->name}}
                        <br>
                        {{$reviews->body}}
                        <br>

                        @if ($reviews->like_or_dislike == "like")
                            <i class="fa fa-thumbs-up" style="font-size: 30px;color: greenyellow"></i>
                        @elseif($reviews->like_or_dislike == "dislike")
                            <i class="fa fa-thumbs-down" style="font-size: 30px;color: red"></i>
                        @endif
                        <br>
                        Total Upvote : {{$totalUpvote}}
                        Total Downvote : {{$totalDownvote}}
                    </div>
                    <div class="card-body">
                        @if( $flagFriendlistOrNot == 0 && $flagFriendlistOrNot2 == 0)

                        @elseif ($pernahVoting == 1 )
                            <strong>You already vote for this review !</strong>
                        @else
                            <a href="{{route('review.upvote',$reviews->id)}}" class="btn btn-success">
                                Up Vote
                            </a>

                            <a href="{{route('review.downvote',$reviews->id)}}" class="btn btn-danger">
                                Down Vote
                            </a>
                        @endif

                    </div>
                </div>
                <br>

            @endforeach


        </div>
    </div>
</div>
@endsection
