@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @foreach ($user as $users)
                        {{$users->name}}<br>
                        {{$users->email}}<br>
                        {{$users->role}}<br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
