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

                    <form action="{{route('user.search_player')}}" method="GET">
                        <!-- Search form -->
                        <div class="md-form active-cyan-2 mb-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="searchName" id="searchName" placeholder="Search player name here" aria-label="Search">
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">
                                        Search
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>

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
