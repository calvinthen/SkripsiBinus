<?php

namespace App\Http\Controllers;

use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friend = DB::table('friends')->where('id_user','LIKE',Auth::user()->id)->orWhere('id_user2','LIKE',Auth::user()->id)->get();


        return view('auth.profileUser.friendlist')->with('friend',$friend);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$mailID)
    {
        $user = DB::table('users')->where('id','LIKE',$id)->first();

        $userID = $user->id;
        $friend = Friend::create([
            'id_user' => $userID,
            'id_user2' => Auth::user()->id,
        ]);

        $friend->id_user = $userID;
        $friend->id_user2 = Auth::user()->id;
        $friend->save();

        DB::table('inboxes')->where('id','LIKE',$mailID)->update(['mail_readed' => "readed"]);

        return redirect()->back()->with('status_friend_accepted','You both has been add to friendlist database');
    }

    public function decline_friend($id)
    {
        DB::table('inboxes')->where('id','LIKE',$id)->update(['mail_readed' => "readed"]);

        return redirect()->back()->with('status_decline_friend','You has been decline a user to become your friendlist !');
    }


    public function remove_friend($id)
    {
        $friendlist = DB::table('friends')->where(['id_user' => Auth::user()->id , 'id_user2' => $id])->delete();
        $friendlist2 = DB::table('friends')->where(['id_user' => $id , 'id_user2' => Auth::user()->id])->delete();

        return redirect()->back()->with('status_friendlist','User has been removed from friendlist !');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
