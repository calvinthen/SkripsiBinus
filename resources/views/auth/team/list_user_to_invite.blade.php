@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center">
                        <strong> <h2> List user with no team</h2></strong>
                </div>

                <div class="card-body" style="background: #C4CAD0">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role Game</th>
                            <th scope="col">Point</th>
                            <th scope="col">invite</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)

                            @php
                                $flagFriendlistOrNot = DB::table('friends')->where(['id_user' => Auth::user()->id , 'id_user2' => $users->id])->count();
                                $flagFriendlistOrNot2 = DB::table('friends')->where(['id_user' => $users->id , 'id_user2' => Auth::user()->id])->count();

                                $ratingTable = DB::table('reviews')->where('receiver_id','LIKE',$users->id)->get();
                                $totalReviewer = DB::table('reviews')->where('receiver_id','LIKE',$users->id)->count();

                                $scoreRatingUser = 0;

                                foreach ($ratingTable as $ratingTables) {
                                    $scoreRatingUser += $ratingTables->score;
                                }

                                if($totalReviewer != 0)
                                {
                                    $averageScoreRating = $scoreRatingUser / $totalReviewer;
                                }
                            @endphp

                                <tr>
                                  <th scope="row">{{$users->id}}</th>
                                  <td>{{$users->name}}</td>
                                  <td>{{$users->role_game}}</td>
                                  <td>
                                    @if ($totalReviewer != 0)
                                        <strong>Average Rating : </strong> {{$averageScoreRating}}
                                    @else
                                        No Vote
                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{route('inbox.create_invitation_team',$users->id)}}" class="btn btn-primary">
                                          Invite
                                      </a>
                                  </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
