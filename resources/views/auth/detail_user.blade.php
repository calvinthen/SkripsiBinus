@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $friendList = DB::table('friends')->where(['id_user'=> Auth::user()->id], ['id_user2' => $user->id])->get();
        $friendList2 = DB::table('friends')->where(['id_user'=> $user->id], ['id_user2' => Auth::user()->id])->get();


        $flagTemenan = $friendList->count();
        $flagTemenan2 = $friendList2->count();

        $flag = 0;
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <h2><strong> Detail User : {{$user->name}}</strong></h2>
                </div>

                <div class="card-body">
                    <img src="{{url('./images/' . $user->photo_profile)}}" alt="" width="150px" height="150px"><br><br>

                    <div class="row">
                        <div class="col-md-12" style="text-align: center">

                        @if ($flagTemenan >= 1)
                            @php
                                $flag++;
                            @endphp
                        @elseif($flagTemenan2 >= 1)
                            @php
                                $flag++;
                            @endphp

                        @endif


                        @if ($flag >= 1)

                        @else
                            <a href="{{route('user.send_friend_request',$user->id)}}">
                                <Button class="btn btn-primary">
                                    Add Friend
                                </Button>
                            </a>
                        @endif
                            <br>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
