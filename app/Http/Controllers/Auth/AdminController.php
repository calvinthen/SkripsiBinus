<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;


class AdminController extends Controller
{

    function index()
    {
        return view('auth.admin.index');
    }

    function view_user()
    {
        $user = DB::table('users')->get();

        return view('auth.admin.viewUser')->with('user',$user);
    }
}
