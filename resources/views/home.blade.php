@extends('layouts.app')

@section('content')
@php
    $recentReview = DB::table('reviews')->orderByDesc('created_at')->take(3)->get();
    $notifikasi = DB::table('inboxes')->where('receiver_id','LIKE',Auth::user()->id)->orderByDesc('created_at')->take(4)->get();
    $posting = DB::table('posts')->orderByDesc('created_at')->take(4)->get();

    $suggestedPlayer = DB::table('users')->where('id','NOT LIKE', Auth::user()->id)->inRandomOrder()->take(3)->get();

    if(Auth::user()->team_id != NULL)
    {
        $team = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
    }



@endphp
<div class="row">

    <div class="col-sm-1">

    </div>

    <div class="col-sm-3">

        <div class="row">
            <div class="card" style="width: 18rem;height: 300px;border-radius: 30px">
                <div class="card-body">
                  <h3 class="card-title" style="text-align: center">
                      <strong>Leaderboard</strong>
                  </h3>

                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                  <a href="{{route('home.leaderboard')}}"  id="see-more-leaderboard" style="color: orange" class="see-more-leaderboard"> <u>See More</u> </a>
                </div>
              </div>
        </div>
        <br>
        <div class="row">
            <div class="card" style="width: 18rem;height: 300px;border-radius: 30px">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center">
                        <strong>Recent Review</strong>
                    </h3>

                    @foreach ($recentReview as $recentReviews)
                        @php
                            $orangYangDireview = DB::table('users')->where('id','LIKE',$recentReviews->receiver_id)->first();
                            $orangYangReview = DB::table('users')->where('id','LIKE',$recentReviews->reviewer_id)->first();
                        @endphp
                        <div class="card" style="width: 245px;height: 60px;border-radius: 50px;background: gray">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{url('./images/' . $orangYangDireview->photo_profile)}}" width="30px" height="30px">
                                        </div>

                                        <div class="col-sm-5">
                                        <strong style="color: black">{{$orangYangDireview->name}}</strong><br>
                                        <small style="color: black">By <strong>{{$orangYangReview->name}}</strong> </small>

                                        </div>

                                        <div class="col-sm-4">
                                            @if ($recentReviews->like_or_dislike == "like")
                                            <i class="fa fa-thumbs-up" style="font-size: 30px;color: greenyellow"></i>
                                            @elseif($recentReviews->like_or_dislike == "dislike")
                                            <i class="fa fa-thumbs-down" style="font-size: 30px;color: red"></i>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                        </div>
                        <br>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-5">

        <div class="row">
            <div class="col-sm-12" style="text-align: center">
                <h3 style="color: white">
                    <strong> <u>Latest Notification</u></strong>
                </h3>
            </div>

        </div>
        <br>

        <a href="{{route('user.post')}}" class="btn btn-primary">
            Create Post
        </a>

        @foreach ($posting as $postings)
            <a href="{{route('post.detail',$postings->id)}}">
                <p style="color: white">{{$postings->post}}</p>

                <img src="{{url('./images/' . $postings->thumbnail)}}" alt="" width="150px" height="150px">
            </a>

        @endforeach

        @foreach ($notifikasi as $notifikasis)
            @php
                $pengirim = DB::table('users')->where('id','LIKE',$notifikasis->sender_id)->first();
            @endphp
            <div class="row">
                <div class="col-sm-12" style="text-align: center">

                    @if ($notifikasis->mail_readed == "readed")
                    <a href="" type="button" data-toggle="modal" data-target="#readMailModal{{$notifikasis->id}}" style="color: black">
                        <div class="card" style="width: 500px;height: 92px;border-radius: 50px;opacity: 0.6;">
                            <div class="card-body">
                                <strong><u>{{$pengirim->name}}</u></strong>
                                @if ($notifikasis->mail_type == "request_friend")
                                    Sent you a friend request
                                @elseif ($notifikasis->mail_type == "request_team")
                                    Sent you a team request

                                @elseif ($notifikasis->mail_type == "invite_team")
                                    Sent you team invitation
                                @endif
                                <br><br>

                                <small style="text-align: right">{{ \Carbon\Carbon::parse($notifikasis->created_at)->format('d/m/Y H:i')}}</small>

                            </div>
                        </div>
                    </a>

                    @else
                    <a href="" type="button" data-toggle="modal" data-target="#readMailModal{{$notifikasis->id}}" style="color: black">
                        <div class="card" style="width: 500px;height: 92px;border-radius: 50px;">
                            <div class="card-body">
                                <strong><u>{{$pengirim->name}}</u></strong>
                                @if ($notifikasis->mail_type == "request_friend")
                                    Sent you a friend request
                                @elseif ($notifikasis->mail_type == "request_team")
                                    Sent you a team request

                                @elseif ($notifikasis->mail_type == "invite_team")
                                    Sent you team invitation
                                @endif
                                <br><br>

                                <small style="text-align: right">{{ \Carbon\Carbon::parse($notifikasis->created_at)->format('d/m/Y H:i')}}</small>

                            </div>
                        </div>
                    </a>

                    @endif

                    @if ($notifikasis->mail_readed == "readed")

                    @else

                    <!-- Modal -->
                    <div class="modal fade" id="readMailModal{{$notifikasis->id}}" tabindex="-1" role="dialog" aria-labelledby="readMailModal{{$notifikasis->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="readMailModal{{$notifikasis->id}}">
                                @if ($notifikasis->mail_type == "invite_team")
                                    <h5>Team Invitation</h5>
                                @elseif($notifikasis->mail_type == "request_team")
                                    <h5>Request team</h5>
                                @elseif($notifikasis->mail_type == "request_friend")
                                    <h5>Request Friend</h5>
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <div class="modal-body">
                                {{$notifikasis->body}}
                            </div>

                            <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}

                            @if ($notifikasis->mail_type == "request_friend")
                                <a href="{{url('user/inbox/accept/friend/' . $notifikasis->sender_id . '/' . $notifikasis->id)}}" class="btn btn-primary">
                                    Accept as Friend
                                </a>

                                <a href="{{route('user.decline_friend',$notifikasis->id)}}" class="btn btn-danger">
                                    Decline user
                                </a>

                            @elseif($notifikasis->mail_type == "request_team")
                                <a href="{{url('user/inbox/accept_team_invitation/' . $notifikasis->sender_id . '/' . $notifikasis->id)}}" class="btn btn-primary">
                                    Accept as member
                                </a>

                                <a href="{{route('user.decline_request_team',$notifikasis->id)}}" class="btn btn-danger">
                                    Decline user
                                </a>
                            @else
                                <a href="{{url('user/inbox/accept_team_invitation/' . $notifikasis->sender_id . '/' . $notifikasis->id)}}" class="btn btn-primary">
                                    Join Team
                                </a>

                                <a href="{{route('user.decline_invitation_team',$notifikasis->id)}}" class="btn btn-danger">
                                    Decline Team
                                </a>
                            @endif


                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- END OF MODAL-->

                    @endif


                </div>

            </div>
            <br>

        @endforeach


    </div>

    <div class="col-sm-2">
        <div class="row">
            <div class="row">
                <div class="card" style="width: 240px;height: 300px;border-radius: 30px">
                    <div class="card-body" style="text-align: center">
                        @if (Auth::user()->team_id == NULL)
                            <a href="{{route('team.create_team_index')}}" class="btn btn-primary">
                                Create Team
                            </a>
                        @elseif(Auth::user()->team_id != NULL)
                        <img src="{{url('./images/' . $team->photo_team)}}" width="100px" height="100px">
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="row"style="text-align: center">
            <h3 style="color: white" >
                <strong> <u>Player we suggest !</u></strong>
            </h3>

        </div>
        <br>

        <div class="row" >
            @foreach ($suggestedPlayer as $suggestedPlayers)

                <div class="col-sm-3">
                    <img src="{{url('./images/' . $suggestedPlayers->photo_profile)}}" width="40px" height="40px">
                </div>

                <div class="col-sm-6">
                   <strong style="color: white">{{$suggestedPlayers->name}}</strong><br>
                   @if ($suggestedPlayers->role_game == "entry fragger")
                   <strong style="color: white">Role: Entry</strong>

                   @elseif ($suggestedPlayers->role_game == "support csgo")
                   <strong style="color: white">Role: Support CS</strong>
                   @else
                   <strong style="color: white">Role: {{$suggestedPlayers->role_game}}</strong>
                   @endif

                </div>

                <div class="col-sm-3">
                    <i class="fa fa-plus" style="color: orange;font-size: 25px"></i>
                </div>
                <br><br><br>
            @endforeach
                <br>

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{route('user.list_user')}}" class="btn btn-warning">Find More !</a>
                </div>
            </div>



        </div>


    </div>

</div>
@endsection
