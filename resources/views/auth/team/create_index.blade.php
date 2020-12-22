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
                          <label for="team_name"> <strong>Team name</strong> </label>
                          <input type="text" class="form-control" id="team_name" name="team_name" placeholder="input your team name" value="{{ old('team_name') }}" required autofocus>

                                @if ($errors->has('team_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <br>

                         <!-- BUAT EDIT FOTO PROFILE -->
                         <div class="form-group {{ $errors->has('uploadFoto') ? ' has-error' : '' }}">
                            <label for="uploadFoto"><strong>Upload Foto : </strong></label>
                            <input type="file" id="uploadFoto" name="uploadFoto" class="form-control" class="form-control" value="{{ old('uploadFoto') }}" required autofocus >
                                @if ($errors->has('uploadFoto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uploadFoto') }}</strong>
                                    </span>
                                @endif
                        </div>



                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary">
                                Confirm team
                            </button>
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

