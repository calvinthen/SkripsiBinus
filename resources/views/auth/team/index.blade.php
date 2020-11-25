@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Team Index</strong></h2>
                </div>

                <div class="card-body">
                    test
                </div>

            </div>

            @php
                $user = DB::table('users')->where('name','LIKE', $user)->get();
            @endphp

            @foreach ($user as $users)
                @if ($users->team != NULL)
                    ada team<br>
                @endif
            @endforeach


            doesn't find any team best for you ? why dont create a new one !
                <a href="{{route('team.create_team_index')}}" class="btn btn-primary">
                    Create Team
                </a>
        </div>
    </div>
</div>


@endsection
