<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $not_readed = 'not_readed';
        $mail = DB::select(DB::raw("select * from inboxes where receiver_id LIKE '$user_id' and  mail_readed LIKE '$not_readed'"));

        return view('auth.profileUser.inbox')->with('mail',$mail);
    }

    public function create_invitation_team($id)
    {
        Inbox::create([
            'body' =>  "Hi, I want to invite you to our team! Please click 'JOIN TEAM' below to become our member!",
            'sender_id' => Auth::user()->id,
            'receiver_id' => $id,
            'mail_type' => "invite_team",

        ]);

        return redirect()->back()->with('status','Invitation has been Sent !');
    }

    public function request_join_team($id)
    {
        $teamToRequest = DB::table('teams')->where('id','LIKE',$id)->first();
        $teamLeaderID = $teamToRequest->leader_id;

        Inbox::create([
            'body' =>  "Hi! i want to join your team , can you accept me as a member?",
            'sender_id' => Auth::user()->id,
            'receiver_id' => $teamLeaderID,
            'mail_type' => "request_team",
        ]);

        return redirect()->back()->with('status','Request has been sent !');
    }

    public function request_friend($id)
    {
        $user_unique_id_receiver = DB::table('users')->where('id','LIKE',$id)->first();

        $unique_id = $user_unique_id_receiver->id;
        Inbox::create([
            'body' =>  "I want to be your friend ! please accept me",
            'sender_id' => Auth::user()->id,
            'receiver_id' => $id,
            'mail_type' => "request_friend",
        ]);

        return redirect()->back()->with('status','Your friend request has been sent!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        //
    }
}
