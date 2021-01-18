@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card" style="background: #292e36; color: #eeeeee">
                <div class="card-header" style="text-align: center"> <strong><h3>{{ __('Create post') }}</h3></strong>  </div>

                @if (session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif

                <div class="card-body" style="background: #373d47">

                    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="post">Post </label>
                            <textarea class="form-control @error('post') is-invalid @enderror" id="post" name="post" rows="3"></textarea>
                                @error('post')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control-file" name="photo" id="photo">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
