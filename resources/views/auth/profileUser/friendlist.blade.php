@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center">
                    <h2><strong> Friendlist </strong></h2>
                </div>

                <div class="card-body" style="background: #C4CAD0">
                    @foreach ($friend as $friends)
                        @php
                            $friendName = DB::table('users')->where('id','LIKE',$friends->id_user)->first();
                            $friendName2 = DB::table('users')->where('id','LIKE',$friends->id_user2)->first();
                        @endphp

                            @if ($friendName->name != Auth::user()->name)

                                <a href="{{route('user.detail',$friendName->id)}}" style="color: black">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{url('./images/' . $friendName->photo_profile)}}" alt="" width="50px" height="50px">
                                        </div>

                                        <div class="col-md-4">
                                            {{$friendName->name}} : Role {{$friendName->role_game}}
                                        </div>

                                    </div>
                                </a>
                                <br>
                            @endif

                            @if ($friendName2->name != Auth::user()->name)
                                <a href="{{route('user.detail',$friendName2->id)}}" style="color: black">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{url('./images/' . $friendName2->photo_profile)}}" alt="" width="50px" height="50px">
                                        </div>

                                        <div class="col-md-4">
                                            {{$friendName2->name}} : Role {{$friendName2->role_game}}
                                        </div>

                                    </div>
                                </a>
                                <br>
                            @endif


                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

