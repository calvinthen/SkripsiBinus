@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card" style="background: #292e36; color: #eeeeee">
                <div class="card-header" style="text-align: center"> <strong><h3>{{ __('Login') }}</h3></strong>  </div>

                @if (session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif

                <div class="card-body" style="background: #373d47">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        Your password or email is incorrect !
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        your password is incorrect!
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 offset-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 13px">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit" class="btn btn-customBlack">
                                        {{ __('Login') }}
                                    </button>
                                </center>
                            </div>
                        </div>

                        <div style="height:30px"></div>

                        <div class="row">
                            <div class="col-sm-4">
                                <hr>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <label style="font-size:11px">or log in using</label>
                                </center>
                            </div>
                            <div class="col-sm-4">
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <a href="/sign-in/google" class="btn btn-customBlack">
                                        <img width="30px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                    </a>
                                </center>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
