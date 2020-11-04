<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function view_profile($id)
    {
        $user = DB::select(DB::raw("select * from users where unique_id like '$id'"));
        $team = DB::table('users')->where('unique_id' , 'LIKE' , $id)->value('team');

        // return dd($team);
        return view('auth.profile')->with('user',$user)->with('team',$team);
    }

    function edit_user_profile()
    {
        return View('auth.profileUser.edit');
    }

}
