@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center"> <h3><strong>Edit profile</strong></h3></div>

                <form method="post" action="{{route('profile.confirm_edit',Auth::user()->unique_id)}}" enctype="multipart/form-data">
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
