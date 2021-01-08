@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center"> <h3><strong>Edit profile</strong></h3></div>

                <form method="post" action="{{route('profile.confirm_edit',Auth::user()->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">

                            <!-- BUAT EDIT FOTO PROFILE -->
                            <div class="form-group col-md-12">
                                <label for="uploadFoto"><strong>Upload Foto : </strong></label>
                                <input type="file" id="uploadFoto" name="uploadFoto" class="form-control">
                            </div>
                            <br>

                            <div class="form-group col-md-12">
                                <label for="changeName"><strong>Input nickname : </strong></label>
                                <input type="text" id="changeName" name="changeName" class="form-control">
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

                                <div class="col-md-8">
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

@section('script')

@endsection
