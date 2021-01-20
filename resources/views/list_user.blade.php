@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h2><strong> List User</strong></h2>
                </div>

                <div class="card-body">

                    <form action="{{route('user.search_player')}}" method="GET">
                        <!-- Search form -->
                        <div class="md-form active-cyan-2 mb-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="searchName" id="searchName" placeholder="Search player name here" aria-label="Search">
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="submit">
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
                                    <select class="form-control" id="role" name="role">
                                        <option>Search player by Role :</option>
                                        <option value="midlaner">Midlaner</option>
                                        <option value="carry">Carry</option>
                                        <option value="offlaner">Offlaner</option>
                                        <option value="support">Support</option>
                                        <option value="hard support">Hard Support</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <Button class="btn btn-primary" type="submit">
                                        Search by Role
                                    </Button>
                                </div>

                            </div>

                        </div>
                    </form>



                    @foreach ($allUser as $user)

                        @if ($user->name == Auth::user()->name)
                            @continue
                        @endif
                        <a href="{{route('user.detail',$user->id)}}" style="color: white">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{url('./images/' . $user->photo_profile)}}" alt="" width="50px" height="50px">
                                </div>

                                <div class="col-md-4">
                                    {{$user->name}} : Role {{$user->role_game}}
                                </div>

                            </div>
                        </a>

                        <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
