@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card" style="background: #292e36; color: #eeeeee">
                <div class="card-header" style="text-align: center"> <strong><h3>{{ __('Change password') }}</h3></strong>  </div>

                <form action="{{route('user.store_new_password')}}" method="POST">
                    @csrf
                    <div class="card-body" style="background: #373d47">

                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldPassword" type="password" class="input @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="new-oldPassword" placeholder="Input your old password">

                                @error('oldPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" required name="password"  autocomplete="new-password" placeholder="Input password with atleast 8 characters">

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
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password" placeholder="Input your confirm password ">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit" class="btn btn-customBlack">
                                        {{ __('Change') }}
                                    </button>
                                </center>
                            </div>
                        </div>



                    </div>
                </form>
            </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
        </div>
    </div>
</div>
@endsection
