@extends('layouts.app')

@section('content')
<div class="container">

    @php
        $myTeam = DB::table('teams')->where('id','LIKE',Auth::user()->team_id)->first();
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team Index</strong></h2>
                </div>

                <div class="card-body"  style="background: #C4CAD0">

                    <form action="" method="">
                        <!-- Search form -->
                        <div class="md-form active-cyan-2 mb-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="searchName" id="searchName" placeholder="Search team name here" aria-label="Search">
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">
                                        Search
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>

                    @foreach ($team as $teams)
                        <a href="{{route('user.view_selected_team',$teams->id)}}" style="color: black">


                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{url('./images/' . $teams->photo_team)}}" alt="" width="50px" height="50px">
                                </div>

                                <div class="col-md-4">
                                    {{$teams->team_name}}
                                </div>

                            </div>
                        </a>
                        <br>
                    @endforeach

                    @if ($user->team == NULL)

                    <div class="row" style="text-align: center">
                        <div class="col-md-12">
                            <a href="{{route('team.create_team_index')}}" class="btn btn-primary">
                                Create Team
                            </a>
                        </div>
                    </div>


                    @elseif($user->team != NULL)
                        <p >Your Current Team : <strong>{{$myTeam->team_name}}</strong><br></p>

                        <img src="{{url('./images/' . $myTeam->photo_team)}}" width="150px" height="150px">
                    @endif
                </div>

            </div>



            <br>





        </div>
    </div>
</div>


@endsection
