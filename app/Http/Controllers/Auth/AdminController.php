<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{

    function index()
    {
        return view('auth.admin.index');
    }
}
