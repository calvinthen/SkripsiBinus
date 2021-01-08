@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Complete your information profile</div>

                <form action="{{route('user.complete_information_store')}}" method="GET">
                    @csrf

                    <div class="card-body">
                     <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="game_prefer" class="col-md-4 col-form-label text-md-right">{{ __('Game prefered') }}</label>

                            <div class="col-md-6">
                                <select name="game_prefer" id="game_prefer" class="form-control">
                                    <option value="">- Select -</option>
                                    <option value="csgo">Counter Strike: Global Offensive</option>
                                    <option value="dota">DotA 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_game" class="col-md-4 col-form-label text-md-right">{{ __('Role in game') }}</label>

                            <div class="col-md-6">
                                <select name="role_game" id="role_game" class="form-control">
                                    <option value="">- Select -</option>
                                    <option value="midlaner">Midlaner</option>
                                    <option value="carry">Carry</option>
                                    <option value="offlaner">Offlaner</option>
                                    <option value="support">Support</option>
                                    <option value="hard support">Hard Support</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ingame_id" class="col-md-4 col-form-label text-md-right">{{ __('Game ID') }}</label>

                            <div class="col-md-6">
                                <input id="ingame_id" type="text" class="form-control @error('ingame_id') is-invalid @enderror" name="ingame_id" value="{{ old('ingame_id') }}" required autocomplete="ingame_id" autofocus>

                                @error('ingame_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">
                                    Confirm Information
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                                <a href="/">
                                    Click here to go to Homepage !
                                </a>
                            </div>
                        @endif

            </div>
        </div>
    </div>
</div>
@endsection
