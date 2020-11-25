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

                        <div class="form-group">
                          <label for="team_name"> <strong>Team name</strong> </label>
                          <input type="text" class="form-control" id="team_name" name="team_name" placeholder="input your team name">
                        </div>
                        <br>

                         <!-- BUAT EDIT FOTO PROFILE -->
                         <div class="form-group">
                            <label for="uploadFoto"><strong>Upload Foto : </strong></label>
                            <input type="file" id="uploadFoto" name="uploadFoto" class="form-control">
                        </div>



                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary">
                                Confirm team
                            </button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

