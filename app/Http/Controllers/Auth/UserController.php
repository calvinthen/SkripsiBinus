<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\Console\Input\Input;



class UserController extends Controller
{
    function delete_user($id)
    {
        $user = DB::table('users')->where('id' , 'LIKe', $id)->delete();

        return redirect()->back();
    }

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

            DB::table('users')->where('id','LIKE',$id)->update(['photo_profile' => $imageName]);
            $flagDataChanges++;
        }

        //BUAT GANTI NAMA
        if($request->input($request->input('changeName')) != NULL)
        {
            DB::table('users')->where('id','LIKE',$id)->update(['name' => $currentName]);
        }
        else if($request->input($request->input('changeName')) == NULL)
        {
            DB::table('users')->where('id','LIKE',$id)->update(['name' => $changeName]);
            $flagDataChanges++;
        }

        $user = DB::select(DB::raw("select * from users where id like '$id'"));
        $team = DB::table('users')->where('id' , 'LIKE' , $id)->value('team');

        if($request->input('game_prefer') != NULL)
        {
            DB::table('users')->where('id','LIKE',Auth::user()->id)->update(['game_prefer' => $request->input('game_prefer')]);
        }

        if($request->input('role_game') != NULL)
        {
            DB::table('users')->where('id','LIKE',Auth::user()->id)->update(['role_game' => $request->input('role_game')]);
        }

        if($request->input('ingame_id') != NULL)
        {
            DB::table('users')->where('id','LIKE',Auth::user()->id)->update(['ingame_id' => $request->input('ingame_id')]);
        }
        if($request->input('password') != NULL)
        {
            DB::table('users')->where('id','LIKE',Auth::user()->id)->update(['password' => Hash::make($request->input('password'))]);
        }

        return view('auth.profile')->with('user',$user)->with('team',$team);
    }

    public function search_player(Request $request)
    {
        $searchName = $request->input('searchName');

        $user = DB::table('users')->where('name','LIKE' , '%' . $searchName . '%')->get();


        return view('search.index')->with('searchName',$searchName)->with('user',$user);
    }

    public function chat_friend_index($id)
    {
        $user = DB::table('users')->where('id','LIKE',$id)->first();

        $chat = DB::table('chats')->where([
            'sender_id' => Auth::user()->id ,'receiver_id' => $id
            ])->get();

            $chat2 = DB::table('chats')->where(function ($query) use($id) {
                $query->where('sender_id' ,'LIKE', Auth::user()->id)
                    ->where('receiver_id' , 'LIKE', $id);
            })->orWhere(function($query)
            use($id)
            {
                $query->where('sender_id' ,'LIKE', $id)
                    ->where('receiver_id' ,'LIKE', Auth::user()->id);
            })->get();


        return view('chat.index')->with('user',$user)->with('chat',$chat2);
    }

    public function search_player_by_role(Request $request)
    {
        $role = $request->input('role');

        $user = DB::table('users')->where('role_game','LIKE',$role)->get();

        return view('search.search_by_role')->with('role',$role)->with('user',$user);
    }

    public function create_post_index()
    {

        return view('index_post');
    }
}
