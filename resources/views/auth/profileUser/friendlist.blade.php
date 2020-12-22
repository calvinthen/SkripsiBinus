@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <h2><strong> Friendlist </strong></h2>
                </div>

                <div class="card-body">
                    @foreach ($friend as $friends)
                        @php
                            $friendName = DB::table('users')->where('id','LIKE',$friends->id_user)->first();
                            $friendName2 = DB::table('users')->where('id','LIKE',$friends->id_user2)->first();
                        @endphp

                            @if ($friendName->name != Auth::user()->name)

                                <a href="{{route('user.detail',$friendName->id)}}" style="color: black">
                                    {{$friendName->name}}
                                </a>
                                <br>
                            @endif

                            @if ($friendName2->name != Auth::user()->name)
                                <a href="{{route('user.detail',$friendName2->id)}}" style="color: black">
                                    {{$friendName2->name}}
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

