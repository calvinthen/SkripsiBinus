@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @foreach ($user as $users)
                        <img src="{{url('./images/' . $users->photo_profile)}}" alt="" width="150px" height="150px"><br>
                        {{$users->name}}<br>
                        {{$users->email}}<br>
                        {{$users->role}}<br>
                        <br>
                    @endforeach

                    <div style="text-align: center">
                        <a href="{{route('profile.edit')}}" class="btn btn-primary">
                            Edit profile
                        </a>
                    </div>

                </div>

            </div>

            @if ($team == NULL)
                it seems you dont have any team registered yet, wanna find or create a team for yours ?
                <br>
                <br><br>

                <!-- DESIGN BUTTON ANIMATION -->
                <div style="text-align: center">
                    <a href="{{route('user.find_team')}}" class="buttonAnimationProfileFindTeam" style="text-decoration: none">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Find Here !
                    </a>
                </div>



            @endif

                        @if (session('status_team'))
                            <div class="alert alert-success">
                                {{ session('status_team_user') }}
                            </div>
                        @endif
        </div>
    </div>
</div>


@endsection

