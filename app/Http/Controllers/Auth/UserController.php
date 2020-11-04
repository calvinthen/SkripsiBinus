<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;

use Symfony\Component\Console\Input\Input;



class UserController extends Controller
{
    function edit_profile(Request $request,$id)
    {

        $currentName = Auth::user()->name;
        $changeName = $request->input('changeName');
        $flagDataChanges = 0;

        if($request->hasFile('uploadFoto'))
        {
            //upload foto ga bisa pake method get wajib post kalo ga , ga bakal ke baca extensionnya ga tau napa
            $imageName = time() . '-' . $id . '.' . request()->file('uploadFoto')->getClientOriginalExtension();
            request()->uploadFoto->move(public_path('images'), $imageName);

            DB::table('users')->where('unique_id','LIKE',$id)->update(['photo_profile' => $imageName]);
            $flagDataChanges++;
        }

        //BUAT GANTI NAMA
        if($request->input($request->input('changeName')) != NULL)
        {
            DB::table('users')->where('unique_id','LIKE',$id)->update(['name' => $currentName]);
        }
        else if($request->input($request->input('changeName')) == NULL)
        {
            DB::table('users')->where('unique_id','LIKE',$id)->update(['name' => $changeName]);
            $flagDataChanges++;
        }

        $user = DB::select(DB::raw("select * from users where unique_id like '$id'"));
        $team = DB::table('users')->where('unique_id' , 'LIKE' , $id)->value('team');

        return view('auth.profile')->with('user',$user)->with('team',$team);
    }
}
