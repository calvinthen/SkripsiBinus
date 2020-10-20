@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!Auth::guest())
                        @if(Auth::user()->email_verified_at == NULL)
                            Please Verified first

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>

                        @else
                            Welcome to home dashboard
                        @endif

                    @else
                        You are not login or registered yet
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
