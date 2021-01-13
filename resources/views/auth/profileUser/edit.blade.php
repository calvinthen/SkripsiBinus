@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"> <h3><strong>Edit profile</strong></h3></div>

                <form method="post" action="{{route('profile.confirm_edit',Auth::user()->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body" style="background: #C4CAD0">
                        <div class="row">

                            <!-- BUAT EDIT FOTO PROFILE -->
                            <div class="form-group col-md-12">
                                <label for="uploadFoto"><strong>Upload Foto : </strong></label>
                                <input type="file" id="uploadFoto" name="uploadFoto" class="form-control">
                            </div>
                            <br>

                            <div class="form-group col-md-12">
                                <label for="changeName"><strong>Change name : </strong></label>
                                <input type="text" id="changeName" name="changeName" class="form-control">
                            </div>

                            <div class="form-group row">
                                <label for="game_prefer" class="col-md-4 col-form-label text-md-right"><strong>{{ __('Game prefered') }}</strong> </label>

                                <div class="col-md-6">
                                    <select name="game_prefer" id="game_prefer" class="form-control">
                                        <option value="">- Select -</option>
                                        <option value="csgo">Counter Strike: Global Offensive</option>
                                        <option value="dota">DotA 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role_game" class="col-md-4 col-form-label text-md-right"> <strong>{{ __('Role in game') }}</strong></label>

                                <div class="col-md-8">
                                    <select name="role_game" id="role_game" class="form-control">
                                        <option value="">- Select -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingame_id" class="col-md-4 col-form-label text-md-right"><strong>{{ __('Game ID') }}</strong></label>

                                <div class="col-md-8">
                                    <input id="ingame_id" type="text" class="form-control" name="ingame_id" value="{{ old('ingame_id') }}" autofocus>

                                </div>
                            </div>
                            <br>
                            <br>
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
        }
        else if (val == "dota")
        {
            $("#role_game").html("<option value='carry'> Carry </option> <option value='Midlaner'>Midlaner</option> <option value='offlaner'> Offlaner </option> <option value='support'> Support </option> <option value='hard support'> Hard Support </option>");

        }
    });

    });
</script>


@section('script')

@endsection
