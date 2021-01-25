@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="text-align: center">
                    <h2><strong>Create your team</strong></h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('team.create_team')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group {{ $errors->has('team_name') ? ' has-error' : '' }}">
                            <label for="team_name">{{ __('Team name :') }}</label>

                            <div>
                                <input id="team_name" type="text" class="input @error('team_name') is-invalid @enderror" name="team_name" value="{{ old('team_name') }}" autocomplete="team_name" placeholder="Input your team name" autofocus>
                                @if ($errors->has('team_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('team_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <br>

                        <div class="form-group {{ $errors->has('uploadFoto') ? ' has-error' : '' }}">
                            <label for="uploadFoto" class="col-form-label">{{ __('Upload Foto :') }}</label>
                            <div>
                                <input id="uploadFoto" type="file" class="input @error('uploadFoto') is-invalid @enderror" name="uploadFoto" value="{{ old('uploadFoto') }}" autocomplete="uploadFoto" autofocus>
                                @if ($errors->has('uploadFoto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uploadFoto') }}</strong>
                                    </span>
                            @endif
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit" class="btn btn-customBlack">
                                        {{ __('Create team') }}
                                    </button>
                                </center>
                            </div>
                        </div>
                        <br>

                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

