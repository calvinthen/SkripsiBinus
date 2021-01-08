<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $user = DB::select(DB::raw("select * from users where id like '$id'"));
        $team = DB::table('users')->where('id' , 'LIKE' , $id)->value('team');

        // return dd($team);
        return view('auth.profile')->with('user',$user)->with('team',$team);
    }

    function edit_user_profile()
    {
        return View('auth.profileUser.edit');
    }

    public function list_user()
    {
        $allUser = DB::table('users')->get();

        return view('list_user')->with('allUser',$allUser);
    }

    public function user_detail_page($id)
    {
        $user = DB::table('users')->where('id','LIKE',$id)->first();
        return view('auth.detail_user')->with('user',$user);
    }

    public function complete_information()
    {

        return view('auth.complete_information');
    }

    public function store_complete_information(Request $request)
    {
        DB::table('users')->where('id','LIKE',Auth::user()->id)->update(
            ['password' => Hash::make($request->input('password')),
             'game_prefer' => $request->input('game_prefer'),
             'role_game' => $request->input('role_game'),
             'ingame_id' => $request->input('ingame_id')
            ]


        );

        return redirect()->back()->with('status','Successfuly Update the information !');
    }

    public function leaderboard_index()
    {

        return view('leaderboard.index');
    }


}
