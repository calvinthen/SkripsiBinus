@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $flagFriendlistOrNot = DB::table('friends')->where(['id_user' => Auth::user()->id , 'id_user2' => $user->id])->count();
        $flagFriendlistOrNot2 = DB::table('friends')->where(['id_user' => $user->id , 'id_user2' => Auth::user()->id])->count();

        $ratingTable = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->get();
        $totalReviewer = DB::table('reviews')->where('receiver_id','LIKE',$user->id)->count();

        $scoreRatingUser = 0;

        foreach ($ratingTable as $ratingTables) {
            $scoreRatingUser += $ratingTables->score;
        }

        if($totalReviewer != 0)
        {
            $averageScoreRating = $scoreRatingUser / $totalReviewer;
        }


    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <h2><strong> Detail User : {{$user->name}}</strong></h2>
                </div>
                <div class="card-body">

                    <img src="{{url('./images/' . $user->photo_profile)}}" alt="" width="150px" height="150px"><br><br>

                    <strong>Team : </strong> {{$user->team}}<br>

                    <strong>Total Reviewer : </strong> {{$totalReviewer}}<br>

                    <strong>Rating : </strong> {{$scoreRatingUser}} <br>

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

                                <a href="{{route('user.remove_friend',$user->id)}}" class="btn btn-warning">
                                    Remove Friend
                                </a>

                                <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                    Report!
                                </button>

                            @endif

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

                                            <div class="form-group">
                                                <select class="form-control" id="isiReport" name="isiReport">
                                                    <option value="Tidak bermain sesuai dengan role">Tidak bermain sesuai dengan role</option>
                                                    <option value="Bersikap toxic atau tidak sopan">Bersikap toxic atau tidak sopan</option>
                                                    <option value="Melakukan tindakan terlarang seperti cheating">Melakukan tindakan terlarang seperti cheating</option>
                                                </select>
                                            </div>

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
</div>
@endsection
