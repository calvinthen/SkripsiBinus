@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"> <strong><h3>{{ __('Register') }}</h3></strong></div>

                <div class="card-body" style="background: #C4CAD0">
                    <form  action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Input your name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="input email format with '@'">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Input password with atleast 8 characters">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Input your confirm password ">
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
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ingame_id" id="ingame_id_label" class="col-md-4 col-form-label text-md-right">{{ __('Game ID') }}</label>

                            <div class="col-md-6">
                                <input id="ingame_id" type="text" class="form-control @error('ingame_id') is-invalid @enderror" name="ingame_id" value="{{ old('ingame_id') }}" autocomplete="ingame_id" autofocus>

                                @error('ingame_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
$(document).ready(function() {

$("#game_prefer").change(function() {
    var val = $(this).val();
    if (val == "csgo")
    {
        $("#role_game").html("<option value='entry fragger'> Entry Fragger </option> <option value='support csgo'> Support </option> <option value='lurker'> Lurker </option> <option value='riflers'> Riflers </option> <option value='leader'> Leader </option>");
        document.getElementById('ingame_id_label').innerHTML = 'CSGO Game ID';
    }
    else if (val == "dota")
    {
        $("#role_game").html("<option value='carry'> Carry </option> <option value='Midlaner'>Midlaner</option> <option value='offlaner'> Offlaner </option> <option value='support'> Support </option> <option value='hard support'> Hard Support </option>");
        document.getElementById('ingame_id_label').innerHTML = 'DotA Game ID';
    }
});

});
</script>
