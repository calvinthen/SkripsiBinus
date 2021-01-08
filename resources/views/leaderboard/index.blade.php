@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $carry = DB::table('users')->where('role_game','LIKE','carry')->orderByDesc('point')->get();
        $midlaner = DB::table('users')->where('role_game' , 'LIKE' , 'midlaner')->orderByDesc('point')->get();
        $offlaner = DB::table('users')->where('role_game' , 'LIKE' , 'offlaner')->orderByDesc('point')->get();
        $support = DB::table('users')->where('role_game' , 'LIKE' , 'support')->orderByDesc('point')->get();
        $hardsupport = DB::table('users')->where('role_game' , 'LIKE' , 'hard support')->orderByDesc('point')->get();

    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Leaderboard by points</div>

                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#carry" class="nav-link active" role="tab" data-toggle="tab"> Carry</a>
                        </li>

                        <li class="nav-item">
                            <a href="#midlaner" class="nav-link" role="tab" data-toggle="tab"> Midlaner</a>
                        </li>

                        <li class="nav-item">
                            <a href="#offlaner" class="nav-link" role="tab" data-toggle="tab"> Offlaner</a>
                        </li>

                        <li class="nav-item">
                            <a href="#support" class="nav-link" role="tab" data-toggle="tab"> Support</a>
                        </li>

                        <li class="nav-item">
                            <a href="#hardsupport" class="nav-link" role="tab" data-toggle="tab"> Hard Support</a>
                        </li>

                    </ul>


                    <div class="tab-content">
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
                                {{$offlaners->name}} <strong>{{$offlaners->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="support">
                            @foreach ($support as $supports)
                                {{$supports->name}} <strong>{{$supports->point}}</strong>

                                <br>
                            @endforeach
                        </div>


                        <div role="tabpanel" class="tab-pane" id="hardsupport">
                            @foreach ($hardsupport as $hardsupports)
                                {{$hardsupports->name}} <strong>{{$hardsupports->point}}</strong>

                                <br>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
