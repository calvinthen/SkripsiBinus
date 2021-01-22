@extends('layouts.app')
<style>
    .leaderboardUser:hover{
        transform: scale(1.1);
    }
</style>
@section('content')
<div class="container">
    @php
        $carry = DB::table('users')->where('role_game','LIKE','carry')->orderByDesc('point')->get();
        $midlaner = DB::table('users')->where('role_game' , 'LIKE' , 'midlaner')->orderByDesc('point')->get();
        $offlaner = DB::table('users')->where('role_game' , 'LIKE' , 'offlaner')->orderByDesc('point')->get();
        $support = DB::table('users')->where('role_game' , 'LIKE' , 'support')->orderByDesc('point')->get();
        $hardsupport = DB::table('users')->where('role_game' , 'LIKE' , 'hard support')->orderByDesc('point')->get();

        //csgo
        $entry = DB::table('users')->where('role_game','LIKE','entry fragger')->orderByDesc('point')->get();
        $supportCSGO = DB::table('users')->where('role_game','LIKE','support csgo')->orderByDesc('point')->get();
        $lurker = DB::table('users')->where('role_game','LIKE','lurker')->orderByDesc('point')->get();
        $rifler = DB::table('users')->where('role_game','LIKE','riflers')->orderByDesc('point')->get();
        $leader = DB::table('users')->where('role_game','LIKE','leader')->orderByDesc('point')->get();

    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header">Leaderboard by points</div>

                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Game</label>
                                <select class="input" id="selectGame" name="selectGame" onchange="gantiTab()" style="background:#292e36">
                                  <option value="dota">Dota 2</option>
                                  <option value="csgo">Counter-Strike: Global Offensive</option>
                                </select>
                              </div>
                        </div>
                    </div>

                    <!-- Tab buat Dota -->
                    <ul class="nav nav-tabs tab-buat-dota" id="tab-buat-dota" >
                        <li class="nav-item">
                            <a href="#carry" class="nav-link active" role="tab" data-toggle="tab" style="color: #eeeeee">
                                 <strong>Carry</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#midlaner" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Midlaner</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#offlaner" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Offlaner</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#support" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Support</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#hardsupport" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Hard Support</strong>
                            </a>
                        </li>

                    </ul>


                    <div class="tab-content tab-sub-buat-dota" id="tab-sub-buat-dota">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="carry">
                            @foreach ($carry as $carries)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$carries->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $carries->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$carries->name}}</h5>
                                                    <strong>Point: {{$carries->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($carries->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$carries->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                                </div>
                            @endforeach

                        </div>


                        <div role="tabpanel" class="tab-pane" id="midlaner">
                            @foreach ($midlaner as $midlaners)
                                <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$midlaners->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $midlaners->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$midlaners->name}}</h5>
                                                    <strong>Point: {{$midlaners->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($midlaners->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$midlaners->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                                </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="offlaner">
                            @foreach ($offlaner as $offlaners)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$offlaners->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $offlaners->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$offlaners->name}}</h5>
                                                    <strong>Point: {{$offlaners->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($offlaners->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$offlaners->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="support">
                            @foreach ($support as $supports)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$supports->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $supports->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$supports->name}}</h5>
                                                    <strong>Point: {{$supports->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($supports->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$supports->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="hardsupport">
                            @foreach ($hardsupport as $hardsupports)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$hardsupports->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $hardsupports->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$hardsupports->name}}</h5>
                                                    <strong>Point: {{$hardsupports->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($hardsupports->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$hardsupports->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <!-- Tab buat Dota -->

                     <!-- Tab buat CSGO -->
                     <ul class="nav nav-tabs tab-buat-csgo" id="tab-buat-csgo" style="display: none">
                        <li class="nav-item">
                            <a href="#entry" class="nav-link active" role="tab" data-toggle="tab" style="color: #eeeeee">
                                 <strong>Entry Fragger</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#supportCSGO" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Support</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#lurker" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Lurker</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#riflers" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Riflers</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#leader" class="nav-link" role="tab" data-toggle="tab" style="color: #eeeeee">
                                <strong>Leader</strong>
                            </a>
                        </li>

                    </ul>


                    <div class="tab-content tab-sub-buat-csgo" id="tab-sub-buat-csgo" style="display: none">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="entry">
                            @foreach ($entry as $entries)
                                <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$entries->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $entries->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$entries->name}}</h5>
                                                    <strong>Point: {{$entries->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($entries->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$entries->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                                </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="supportCSGO">
                            @foreach ($supportCSGO as $supportCSGOs)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$supportCSGOs->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $supportCSGOs->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$supportCSGOs->name}}</h5>
                                                    <strong>Point: {{$supportCSGOs->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($supportCSGOs->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$supportCSGOs->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="lurker">
                            @foreach ($lurker as $lurkers)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$lurkers->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $lurkers->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$lurkers->name}}</h5>
                                                    <strong>Point: {{$lurkers->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($lurkers->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$lurkers->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="riflers">
                            @foreach ($rifler as $riflers)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$riflers->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $riflers->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$riflers->name}}</h5>
                                                    <strong>Point: {{$riflers->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($riflers->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$riflers->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="leader">
                            @foreach ($leader as $leaders)
                            <div class="row">
                                <a id="leaderBoardName" href="{{route('user.detail',$leaders->id)}}" style="width:100%; text-decoration: none; color:#eeeeee;">   
                                    <div class="card leaderboardUser" style="margin:10px; transition: .5s">
                                        <div class="card-body" style="background: #272b31; border: 1px solid #393e46">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="img-fluid" src="{{url('./images/' . $leaders->photo_profile)}}" style="max-width:100px; height:100px; border: 1px solid #222831; border-radius: 50px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h5>{{$leaders->name}}</h5>
                                                    <strong>Point: {{$leaders->point}}</strong>
                                                    <br>     
                                                    <strong>
                                                        @if ($leaders->team == "")
                                                            Team: -
                                                        @else
                                                            Team: {{$leaders->team}}
                                                        @endif
                                                    </strong>         
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <!-- Tab buat CSGO -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


<script>
    var tab = 0;
    function gantiTab()
    {

        if(tab == 0)
        {
            document.getElementById("tab-buat-dota").style.display ="none";
            document.getElementById("tab-sub-buat-dota").style.display ="none";

            document.getElementById("tab-buat-csgo").style.display = "";
            document.getElementById("tab-sub-buat-csgo").style.display = "";

            tab = 1;
        }
        else if(tab == 1)
        {
            document.getElementById("tab-buat-dota").style.display ="";
            document.getElementById("tab-sub-buat-dota").style.display ="";

            document.getElementById("tab-buat-csgo").style.display = "none";
            document.getElementById("tab-sub-buat-csgo").style.display = "none";
            tab = 0;
        }

    }
</script>
