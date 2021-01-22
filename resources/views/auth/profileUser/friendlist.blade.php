@extends('layouts.app')
<style>
    #friend:hover{
        transform: scale(1.1);
    }
    .friend:hover{
        transform: scale(1.1);
    }

</style>
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h2><strong> Friendlist </strong></h2>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <a href="{{route('user.list_user')}}" class="btn btn-customWhite">
                Find More !
            </a>
        </div>
    </div>

    @foreach ($friend as $friends)
    @php
        $friendName = DB::table('users')->where('id','LIKE',$friends->id_user)->first();
        $friendName2 = DB::table('users')->where('id','LIKE',$friends->id_user2)->first();
    @endphp

    @if ($friendName->name != Auth::user()->name)

    <div class="row" style="margin-top:10px">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <a id="friend" href="{{route('user.detail',$friendName->id)}}" style="text-decoration: none; color:#eeeeee;">
                <div class="card friend" style="transition: .5s">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="{{url('./images/' .  $friendName->photo_profile)}}" alt="" width="80px" height="80px" style="border-radius:40px">
                            </div>
                            <div class="col-sm-7">
                                <h5>{{$friendName->name}}</h5>
                                Prefered Game: {{$friendName->game_prefer}}<br>
                                Role: {{$friendName->role_game}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-2"></div>
    </div>

    @endif

    @if ($friendName2->name != Auth::user()->name)
    <div class="row" style="margin-top:10px">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <a id="friend" href="{{route('user.detail',$friendName2->id)}}" style="text-decoration: none; color:#eeeeee;">
                <div class="card friend" style="transition: .5s">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="{{url('./images/' .  $friendName2->photo_profile)}}" alt="" width="80px" height="80px" style="border-radius:40px">
                            </div>
                            <div class="col-sm-7">
                                <h5>{{$friendName2->name}}</h5>
                                Prefered Game: {{$friendName2->game_prefer}}<br>
                                Role: {{$friendName2->role_game}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-2"></div>
    </div>

    @endif

    @endforeach


</div>
@endsection

