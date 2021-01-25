@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center"> <h3><strong>Edit profile</strong></h3></div>

                <form method="post" action="{{route('profile.confirm_edit',Auth::user()->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body" >
                        <div class="row">

                            <!-- BUAT EDIT FOTO PROFILE -->

                            <div class="form-group col-md-12">
                                <label for="uploadFoto" class="col-form-label">{{ __('Upload Foto :') }}</label>
                                <div>
                                    <input id="uploadFoto" type="file" class="input @error('uploadFoto') is-invalid @enderror" name="uploadFoto" value="{{ old('uploadFoto') }}" autocomplete="uploadFoto" autofocus>
                                    @error('uploadFoto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br>


                            <div class="form-group col-md-12">
                                <label for="changeName" class="col-form-label">{{ __('Change Name :') }}</label>

                                <div>
                                    <input id="changeName" type="text" class="input @error('changeName') is-invalid @enderror" name="changeName" value="{{ old('changeName') }}" autocomplete="changeName" placeholder="Input your name" autofocus>
                                    @error('changeName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="game_prefer">{{ __('Game prefered') }}</label>

                                <div>
                                    <select name="game_prefer" id="game_prefer" class="input @error('game_prefer') is-invalid @enderror" name="game_prefer" value="{{ old('game_prefer') }}" autocomplete="game_prefer" autofocus>
                                        <option value="">- Select -</option>
                                        <option value="csgo">Counter Strike: Global Offensive</option>
                                        <option value="dota">DotA 2</option>
                                    </select>

                                    @error('game_prefer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="role_game" class="">{{ __('Role in game') }}</label>

                                <div>
                                    <select name="role_game" id="role_game" class="input">
                                        <option value="">- Select -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="ingame_id" id="ingame_id_label">{{ __('Game ID') }}</label>

                                <div >
                                    <input id="ingame_id" type="text" class="input @error('ingame_id') is-invalid @enderror" name="ingame_id" value="{{ old('ingame_id') }}" autocomplete="ingame_id" autofocus placeholder="input your game ID">

                                    @error('ingame_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12" style="text-align: center">
                                <button class="btn btn-primary" type="submit">
                                    Confirm
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

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
            document.getElementById('ingame_id_label').innerHTML = '<strong> CSGO Game ID </strong>';
        }
        else if (val == "dota")
        {
            $("#role_game").html("<option value='carry'> Carry </option> <option value='Midlaner'>Midlaner</option> <option value='offlaner'> Offlaner </option> <option value='support'> Support </option> <option value='hard support'> Hard Support </option>");
            document.getElementById('ingame_id_label').innerHTML = '<strong> DotA Game ID </strong>';
        }
    });

    });
</script>


@section('script')

@endsection
