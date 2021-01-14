@extends('layouts.app')

@section('content')
@php
    $recentReview = DB::table('reviews')->orderByDesc('created_at')->take(3)->get();
    $notifikasi = DB::table('inboxes')->orderByDesc('created_at')->take(4)->get();

    $suggestedPlayer = DB::table('users')->where('id','NOT LIKE', Auth::user()->id)->inRandomOrder()->take(3)->get();


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
                                            <strong style="color: orange"> {{$recentReviews->score}}/10</strong>
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

        @foreach ($notifikasi as $notifikasis)
            @php
                $pengirim = DB::table('users')->where('id','LIKE',$notifikasis->sender_id)->first();
            @endphp
            <div class="row">
                <div class="col-sm-12" style="text-align: center">
                    <div class="card" style="width: 500px;height: 92px;border-radius: 50px">
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
                </div>

            </div>
            <br>

        @endforeach


    </div>

    <div class="col-sm-2">
        <div class="row">
            <div class="row">
                <div class="card" style="width: 240px;height: 300px;border-radius: 30px">
                    <div class="card-body">


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

                <div class="col-sm-4">
                    photo
                </div>

                <div class="col-sm-5">
                   <strong style="color: white">{{$suggestedPlayers->name}}</strong><br>
                   @if ($suggestedPlayers->role_game == "entry fragger")
                   <strong style="color: white">Role: Entry</strong>
                   @else
                   <strong style="color: white">Role: {{$suggestedPlayers->role_game}}</strong>
                   @endif

                </div>

                <div class="col-sm-3">
                    <i class="fa fa-plus" style="color: orange;font-size: 25px"></i>
                </div>
                <br><br><br>
            @endforeach

        </div>


    </div>

</div>
@endsection
