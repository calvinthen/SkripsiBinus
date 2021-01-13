@extends('layouts.app')

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
            <div class="card" style="background: #8C949D">
                <div class="card-header">Leaderboard by points</div>

                <div class="card-body" style="background: #C4CAD0">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Game</label>
                                <select class="form-control" id="selectGame" name="selectGame" onchange="gantiTab()">
                                  <option value="dota">Dota 2</option>
                                  <option value="csgo">Counter-Strike: Global Offensive</option>
                                </select>
                              </div>
                        </div>
                    </div>

                    <!-- Tab buat Dota -->
                    <ul class="nav nav-tabs tab-buat-dota" id="tab-buat-dota">
                        <li class="nav-item">
                            <a href="#carry" class="nav-link active" role="tab" data-toggle="tab" style="color: black">
                                 <strong>Carry</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#midlaner" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Midlaner</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#offlaner" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Offlaner</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#support" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Support</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#hardsupport" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Hard Support</strong>
                            </a>
                        </li>

                    </ul>


                    <div class="tab-content tab-sub-buat-dota" id="tab-sub-buat-dota">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="carry">
                            @foreach ($carry as $carries)

                                <a href="{{route('user.detail',$carries->id)}}" style="color: black">
                                    {{$carries->name}}
                                </a>
                                <strong>{{$carries->point}}</strong>

                                <br>
                            @endforeach

                        </div>


                        <div role="tabpanel" class="tab-pane" id="midlaner">
                            @foreach ($midlaner as $midlaners)

                                <a href="{{route('user.detail',$midlaners->id)}}" style="color: black">
                                    {{$midlaners->name}}
                                </a>
                                <strong>{{$midlaners->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="offlaner">
                            @foreach ($offlaner as $offlaners)

                                <a href="{{route('user.detail',$offlaners->id)}}" style="color: black">
                                    {{$offlaners->name}}
                                </a>
                                <strong>{{$offlaners->point}}</strong>


                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="support">
                            @foreach ($support as $supports)

                                <a href="{{route('user.detail',$supports->id)}}" style="color: black">
                                    {{$supports->name}}
                                </a>
                                <strong>{{$supports->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="hardsupport">
                            @foreach ($hardsupport as $hardsupports)

                                <a href="{{route('user.detail',$hardsupports->id)}}" style="color: black">
                                    {{$hardsupports->name}}
                                </a>
                                <strong>{{$hardsupports->point}}</strong>

                                <br>
                            @endforeach
                        </div>

                    </div>
                    <!-- Tab buat Dota -->

                     <!-- Tab buat CSGO -->
                     <ul class="nav nav-tabs tab-buat-csgo" id="tab-buat-csgo" style="display: none">
                        <li class="nav-item">
                            <a href="#entry" class="nav-link active" role="tab" data-toggle="tab" style="color: black">
                                 <strong>Entry Fragger</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#supportCSGO" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Support</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#lurker" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Lurker</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#riflers" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Riflers</strong>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#leader" class="nav-link" role="tab" data-toggle="tab" style="color: black">
                                <strong>Leader</strong>
                            </a>
                        </li>

                    </ul>


                    <div class="tab-content tab-sub-buat-csgo" id="tab-sub-buat-csgo" style="display: none">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="entry">
                            @foreach ($entry as $entries)

                                <a href="{{route('user.detail',$entries->id)}}" style="color: black">
                                    {{$entries->name}}
                                </a>
                                <strong>{{$entries->point}}</strong>

                                <br>
                            @endforeach

                        </div>


                        <div role="tabpanel" class="tab-pane" id="supportCSGO">
                            @foreach ($supportCSGO as $supportCSGOs)

                                <a href="{{route('user.detail',$supportCSGOs->id)}}" style="color: black">
                                    {{$supportCSGOs->name}}
                                </a>
                                <strong>{{$supportCSGOs->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="lurker">
                            @foreach ($lurker as $lurkers)

                                <a href="{{route('user.detail',$lurkers->id)}}" style="color: black">
                                    {{$lurkers->name}}
                                </a>
                                <strong>{{$lurkers->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="riflers">
                            @foreach ($rifler as $riflers)

                                <a href="{{route('user.detail',$riflers->id)}}" style="color: black">
                                    {{$riflers->name}}
                                </a>
                                <strong>{{$riflers->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="leader">
                            @foreach ($leader as $leaders)

                                <a href="{{route('user.detail',$leaders->id)}}" style="color: black">
                                    {{$leaders->name}}
                                </a>
                                <strong>{{$leaders->point}}</strong>

                                <br>
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
