@extends('layouts.app')
<style>
    #namaUser:hover{
        color:#cccccc !important
    }
</style>

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h2><strong> Search Player : {{$orangYangDicari}}</strong></h2>
                </div>

                <div class="card-body">

                    <form action="{{route('user.search_player')}}" method="GET">
                        <!-- Search form -->
                        <div class="md-form active-cyan-2 mb-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <input class="input" type="text" name="searchName" id="searchName" placeholder="Search player name here" aria-label="Search" style="background: #292e36">
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-customBlack" type="submit" style="width: 100%">
                                        Search by Name
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>

                    <form action="{{route('user.search_player_by_role')}}" method="GET">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <select class="input" id="role" name="role" style="background: #292e36">
                                        <option disabled selected>Search player by Role :</option>
                                        <option value="midlaner">Midlaner</option>
                                        <option value="carry">Carry</option>
                                        <option value="offlaner">Offlaner</option>
                                        <option value="support">Support</option>
                                        <option value="hard support">Hard Support</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <Button class="btn btn-customBlack" type="submit" style="width: 100%">
                                        Search by Role
                                    </Button>
                                </div>

                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @foreach ($allUser as $user)

    <div class="row" style="margin-top:10px">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="{{route('user.detail',$user->id)}}" style="text-decoration: none">
                                <img src="{{url('./images/' . $user->photo_profile)}}" alt="" width="80px" height="80px" style="border-radius:40px">
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <a id="namaUser" href="{{route('user.detail',$user->id)}}" style="text-decoration: none; color:#eeeeee; transition: .5s">
                                <h5>{{$user->name}}</h5>
                            </a>
                            Prefered Game: {{$user->game_prefer}}<br>
                            Role: {{$user->role_game}}
                        </div>
                        <div class="col-sm-3">
                            {{-- langsung add friend tanpa liat profile --}}
                            <button class="btn btn-customBlack" style="width:100%">Add as Friend</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>

    @endforeach


</div>
@endsection
