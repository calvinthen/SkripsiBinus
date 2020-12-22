@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <h2><strong> List User</strong></h2>
                </div>

                <div class="card-body">
                    @foreach ($allUser as $user)

                        @if ($user->name == Auth::user()->name)
                            @continue
                        @endif
                        <a href="{{route('user.detail',$user->id)}}" style="color: black">
                            {{$user->name}}
                        </a>

                        <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
