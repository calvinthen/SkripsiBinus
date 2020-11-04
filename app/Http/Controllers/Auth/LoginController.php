<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use App\User;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *php
     * @return \Illuminate\Http\Response
     */
    public function googleRedirect()
    {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('email', $user->email)->first();

        if($findUser)
        {
            Auth::login($findUser);
        }
        else
        {
            $inserUser = new User;
            $inserUser->name = $user->name;
            $inserUser->email = $user->email;
            $inserUser->password = bcrypt($user->name);
            $inserUser->role = 'user';
            $inserUser->remember_token = NULL;
            $inserUser->email_verified_at = now();
            $inserUser->unique_id = Str::random(20);
            $inserUser->save();

            Auth::login($inserUser);
        }


        return redirect('/');

    }

}
