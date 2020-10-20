<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use App\User;
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

        // $user = User::create([
        //     ['email' => $user->email],
        //     ['name' => $user->name],
        //     ['password' => Hash::make(Str::random(12))],

        // ]);

        $inserUser = new User;
        $inserUser->name = $user->name;
        $inserUser->email = $user->email;
        $inserUser->password = Hash::make(Str::random(14));
        $inserUser->role = 'user';
        $inserUser->remember_token = NULL;
        $inserUser->email_verified_at = now();
        $inserUser->save();

        Auth::login($user,true);

        return redirect('/');

        // $user->token;
    }

}
