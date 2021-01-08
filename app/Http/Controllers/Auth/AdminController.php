<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
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

    public function report()
    {

        $report = DB::table('reports')->get();

        return view('auth.admin.report')->with('report',$report);
    }

    public function confirm_report($id)
    {
        DB::table('reports')->where('id','LIKE',$id)->update(['validation' => "checked"]);


        return redirect()->back();
    }

    public function banned_user(Request $request, $id)
    {
        $hari = $request->input('banned');

        $dateBanned = Carbon::now()->addDays($hari);

        $user = DB::table('users')->where('id', 'LIKE' , $id)->first();

        DB::table('users')->where('id','LIKE',$id)->update(['banned_until' => $dateBanned]);

        return redirect()->back()->with('banned_status', 'you has been banned ' . $user->name . ' for ' . $hari . 'Days');
    }
}
