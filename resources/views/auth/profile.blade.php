@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"> <h3><strong>Profile</strong></h3></div>

                <div class="card-body" style="background: #C4CAD0">
                    @foreach ($user as $users)
                        <img src="{{url('./images/' . $users->photo_profile)}}" alt="" width="150px" height="150px"><br><br>
                        <input name="namaProfile" id="namaProfile" type="text" value="{{$users->name}}" readonly class="form-control">
                        {{$users->email}}<br>
                        {{$users->role}}<br>
                        <br>
                    @endforeach

                    <div style="text-align: center">

                        <a href="{{route('profile.edit')}}"> <i class="fa fa-cog" style="font-size: 50px;color: black" ></i> </a>
                    </div>

                </div>

            </div>

            {{-- @if ($team == NULL)
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



            @endif --}}

                        @if (session('status_team'))
                            <div class="alert alert-success">
                                {{ session('status_team_user') }}
                            </div>
                        @endif
        </div>
    </div>
</div>


@endsection

