@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .square {
        width: 30px;
        height: 30px;
        background: #1c2025;
        border: 1px solid #0a0c0e;

        transition: 0.5s;
    }
    .square:hover {
        background: #0e1013;
        color: #cccccc;
        border: 1px solid #cccccc;
    }
    .suggestion{
        transition: 0.5s;
    }
    .suggestion:hover{
        z-index:1;
        transform: scale(1.2);
    }

    .reviewer{
        text-decoration: none !important;
        color: #eeeeee !important;
        transition: 0.5s;
    }

    .reviewer:hover{
        color: #cccccc !important;
    }

    .reviewed{
        text-decoration: none !important;
        color: #eeeeee !important;
        transition: 0.5s;
    }

    .reviewed:hover{
        color: #cccccc !important;
    }

    .rowPLEASE{
        position: relative;
        /* margin-top: 30px; */
    }

    .postStyle{
        transition: 0.5s;
    }
    .postStyle:hover{
        transition: 0.5s;
        z-index:1;
        transform: scale(1.1);
    }

    .postBody{
        transition: 0.5s;
    }
    .postBody:hover{
        color:#cccccc;
        background-color: #1c2025;
    }


</style>
@section('content')
@php
    $recentReview = DB::table('reviews')->orderByDesc('created_at')->take(5)->get();
    $suggestedPlayer = DB::table('users')   ->where('id','<>', Auth::user()->id)
                                            ->where('game_prefer', '=', Auth::user()->game_prefer)
                                            ->inRandomOrder()->take(3)->get();

    if(Auth::user()->team_id != NULL)
    {
        $team = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
    }

    $leaderboardByRole = DB::table('users') ->where('game_prefer','LIKE', Auth::user()->game_prefer)
                                            ->where('role_game','LIKE', Auth::user()->role_game)
                                            ->orderByDesc('point')->take(3)->get();
@endphp
<div class="row">

    <div class="col-sm-1"></div>

    <div id="leftColID" class="col-sm-3">
        <div class="row d-flex justify-content-center">
            <div class="rowPLEASE">
                <div class="row">
                    <h3 style="color: #eeeeee">
                        <strong>Leaderboard</strong>
                    </h3>
                </div>

                <div class="row" style="color: #eeeeee">
                    <strong>Game: {{Auth::user()->game_prefer}}</strong>
                </div>
                <div class="row" style="color: #eeeeee">
                    <strong>Role: {{Auth::user()->role_game}}</strong>
                </div>

            </div>

            @foreach ($leaderboardByRole as $leaderboard)
                <div class="card" style="width:90%; background: #292e36; color: #eeeeee; margin-top:5px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img class="img-fluid" src="{{url('./images/' . $leaderboard->photo_profile)}}" style="max-width:50px; height:auto; border: 1px solid #222831; border-radius: 25px;">
                            </div>

                            <div class="col-sm-8">
                                {{-- HREF KE ORANG YANG DIREVIEW --}}
                                <a href="{{route('user.detail',$leaderboard->id)}}">
                                    <h4>{{$leaderboard->name}}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row d-flex justify-content-center" style="margin-top: 50px">
            <h3 style="color: #eeeeee">
                <strong>Recent Review</strong>
            </h3>

            @foreach ($recentReview as $recentReviews)
                @php
                    $orangYangDireview = DB::table('users')->where('id','LIKE',$recentReviews->receiver_id)->first();
                    $orangYangReview = DB::table('users')->where('id','LIKE',$recentReviews->reviewer_id)->first();
                @endphp
                <div class="card" style="width:90%; margin-top:5px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img class="img-fluid" src="{{url('./images/' . $orangYangDireview->photo_profile)}}" style="max-width:50px; height:auto; border: 1px solid #222831; border-radius: 25px;">
                            </div>

                            <div class="col-sm-5">
                                {{-- HREF KE ORANG YANG DIREVIEW --}}
                                <a class="reviewed" href="{{route('user.detail',$orangYangDireview->id)}}"><strong style="font-size: 12px"><b>{{$orangYangDireview->name}}</b></strong></a>
                                <br>
                                {{-- HREF KE ORANG YANG REVIEW --}}
                                <small>By <a class="reviewer" href="{{route('user.detail',$orangYangReview->id)}}"><strong>{{$orangYangReview->name}}</strong></a> </small>
                            </div>

                            <div class="col-sm-4">
                                @if ($recentReviews->like_or_dislike == "like")
                                    <i class="fa fa-thumbs-up" style="font-size: 30px;color: greenyellow; float:right"></i>
                                @elseif($recentReviews->like_or_dislike == "dislike")
                                    <i class="fa fa-thumbs-down" style="font-size: 30px;color: red; float:right"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$recentReviews->body}}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

    @php
        $post = DB::table('posts')->orderByDesc('created_at')->take(5)->get();
    @endphp
    <div id="midColID" class="col-sm-5">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- BUAT POSTING DI SINI AJA --}}
                    <div class="card" style="width:90%; border: 2px solid #292e36">
                        <div class="card-header" style="background: #222831">
                            <textarea  class="input @error('post') is-invalid @enderror" name="post" id="post" rows="2" style="border-bottom: 0px; background: #222831" placeholder="Post Here!"></textarea>
                                @error('post')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="file" id="pict" name="pict" style="display: none;" />
                                    <button id="pictButton" class="btn btn-customBlack" style="width:60%" onclick="document.getElementById('pict').click();">Attach Picture</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-customBlack float-right" type="submit" style="width:50%">Post</button>
                                    <button id="pictButtonSmall" class="btn btn-customBlack float-right" style="width:40%;height:37px; margin-right:10px" onclick="document.getElementById('pict').click();">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" style="margin-top: 10px">
            <div class="row" style="margin-top: 10px">
                {{-- GUA MASUKIN 1 CONTOH CARD, LU TINGGAL EDIT BIAR PAKE FOREACH --}}
                @foreach ($post as $posts)
                @php
                    $orangYangPosting = DB::table('users')->where('id','LIKE',$posts->user_id)->first();
                @endphp
                <div class="card postStyle" style="width:90%; background: #292e36; color: #eeeeee; margin-top:5px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-2">
                                {{-- GANTI FOTO ORANG YANG POST & HREF KE PROFIL YANG POST--}}
                                <a href="{{route('user.detail',$posts->user_id)}}">
                                    <img class="img-fluid" src="{{url('./images/' . $orangYangPosting->photo_profile)}}" style="max-width:50px; height:auto; border: 1px solid #222831; border-radius: 25px;">
                                </a>
                            </div>

                            <div class="col-sm-5">
                                {{-- GANTI HREF KE PROFILE ORANG YANG POST, SAMA KAYAK ATAS--}}
                                <a class="reviewed" href="{{route('user.detail',$posts->user_id)}}"><strong style="font-size: 12px"><b></b></strong></a>
                                <br>
                                {{-- GANTI KE WAKTU, FORMATNYA date("F j, Y, g:i a") resultnya harusnya contoh: March 10, 2001, 5:16 pm --}}
                                <small>{{ \Carbon\Carbon::parse($posts->created_at)->format('F j, Y, g:i a')}}</small>
                            </div>
                        </div>
                    </div>
                    {{-- BODYNYA DI HREF KE DETAIL POSTNYA --}}
                    <a href="{{route('post.detail',$posts->id)}}" style="text-decoration: none; color: #eeeeee">
                    <div class="card-body postBody">
                        <div class="col-sm-8">
                            {{$posts->post}}
                        </div>
                        <div class="col-sm-4">
                            {{-- FOTO POSTNYA, (jika ada), KALO GA ADA, DIV INI ILANG, TRUS YANG ATAS JADI COL-SM-12 --}}
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach

            </div>

        </div>
    </div>

    <div id="rightColID" class="col-sm-2">
        <div class="row">
            @if (Auth::user()->team_id == NULL)
                <div id="createTeam" style="width:50%">
                    {{-- CREATE TEAM --}}
                    <a href="{{route('team.create_team_index')}}" style="text-decoration: none;">
                        {{-- BACKGROUND BELUM SELESAI (TUNGGU RIZKY)--}}
                        <div id="trapezoidRight">
                        </div>
                    </a>
                </div>

                <div id="joinTeam" style="width:50%">
                    {{-- JOIN TEAM & TOLONG DI HREF KE TEAM LIST--}}
                    <a href="{{route('user.find_team')}}" style="text-decoration: none; float:right">
                        {{-- BACKGROUND BELUM SELESAI (TUNGGU RIZKY) --}}
                        <div id="trapezoidLeft">
                        </div>
                    </a>
                </div>


            @elseif(Auth::user()->team_id != NULL)
            <div class="row">
            <div class="card col-sm-7">
                <div class="body">
                    {{-- GET USER DALAM TIM, DIV SQUARENYA GANTI PAKE FOTO TIM MEMBER --}}
                    <center>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-sm-4">
                            <div class="square">
                                <i class="fa fa-plus" style="margin-top:7px" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="square">
                                <i class="fa fa-plus" style="margin-top:7px" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="square">
                                <i class="fa fa-plus" style="margin-top:7px" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px; margin-bottom:20px">
                        <div class="col-sm-6">
                            <div class="square">
                                <i class="fa fa-plus" style="margin-top:7px" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="square">
                                <i class="fa fa-plus" style="margin-top:7px" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    </center>
                </div>
            </div>
            <div class="card col-sm-5">
                <div class="body">
                    <a href="{{route('team.user_team_index')}}">
                        <img class="float-right" src="{{url('./images/' . $team->photo_team)}}" width="100%" height="90px">
                    </a>

                </div>
            </div>
            </div>

            @endif
        </div>


        <div class="row"style="text-align: center; margin-top:80px">
            <h3 style="color: #eeeeee" >
                Cool players with the same game as you
            </h3>
        </div>

        {{-- HREF KE PROFILE PLAYERNYA YOOO --}}
        @foreach ($suggestedPlayer as $suggestedPlayers)
        <a href="{{route('user.detail',$suggestedPlayers->id)}}" style="text-decoration: none">
        <div class="row">
            <div class="card suggestion" style="width: 100%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-fluid" src="{{url('./images/' . $suggestedPlayers->photo_profile)}}" style="max-width:40px; max-height:auto; border: 1px solid #222831; border-radius: 25px;">
                        </div>
                        <div class="col-sm-7">
                            <strong style="color: #eeeeee">{{$suggestedPlayers->name}}</strong><br>
                            @if ($suggestedPlayers->role_game == "entry fragger")
                            <strong style="color: #eeeeee">Role: Entry</strong>
                            @elseif ($suggestedPlayers->role_game == "support csgo")
                            <strong style="color: #eeeeee">Role: Support CS</strong>
                            @else
                            <strong style="color: #eeeeee">Role: {{$suggestedPlayers->role_game}}</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
        @endforeach

        <div class="row d-flex justify-content-center" style="margin-top:10px">
            <a href="{{route('user.list_user')}}" class="btn btn-customWhite">
                Find More !
            </a>
        </div>
    </div>

</div>

@endsection

<script>

$(document).ready(function(){
  $("#trapezoidRight").hover(function(){
        $("#trapezoidRight").css("width", "210px");
        $("#trapezoidLeft").css("width", "20px");
    }, function(){
        $("#trapezoidRight").css("width", "130px");
        $("#trapezoidLeft").css("width", "130px");
  });
  $("#trapezoidLeft").hover(function(){
        $("#trapezoidLeft").css("width", "210px");
        $("#trapezoidRight").css("width", "20px");
    }, function(){
        $("#trapezoidLeft").css("width", "130px");
        $("#trapezoidRight").css("width", "130px");
  });
});
</script>

