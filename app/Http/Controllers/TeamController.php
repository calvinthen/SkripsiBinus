<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->where('unique_id', 'LIKE', Auth::user()->unique_id)->first();
        $team = DB::table('teams')->get();

        return view('auth.team.index')->with('user',$user)->with('team',$team);
    }

    public function create_team_index()
    {

        return view('auth.team.create_index');
    }

    public function detail_index($id)
    {
        $team = DB::table('teams')->where('id','LIKE',$id)->first();

        return view('auth.team.detail_selected_team')->with('team',$team);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $team_name = $request->input("team_name");
        $flagNamaTeamSama = 0;

        $allTeams = DB::table('teams')->get();

        foreach($allTeams as $allTeam)
        {
            if($allTeam->team_name == $team_name)
            {
                $flagNamaTeamSama++;
            }
        }

        $id = Str::random(16);
        $unique_id = Auth::user()->unique_id;

        if($flagNamaTeamSama >= 1)
        {
            return redirect()->back()->with('status', 'Nama Team Sudah ada! silahkan gunakan nama lain');
        }
        else if($flagNamaTeamSama == 0)
        {
        $nama = Auth::user()->name;
        $user = DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team' => $team_name]);

        $user2 = DB::table('users')->where('unique_id', 'LIKE', Auth::user()->unique_id)->first();
        $team_photo = time() . '-' . $id . '.' . request()->file('uploadFoto')->getClientOriginalExtension();
        request()->uploadFoto->move(public_path('images'), $team_photo);

        $newTeam = Team::create([
            'team_name' =>  $team_name,
            'rank' => "0",
            'photo_team' => $team_photo,
            // 'user_id' => Auth::user()->id,
            'leader_id' => Auth::user()->unique_id,
        ]);

        DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team_id' => $newTeam->id]);

        $team = DB::table('teams')->get();
        return view('auth.team.index')->with('user',$user2)->with('team',$team);
    }
    }

    public function find_member_index()
    {
        $user = DB::table('users')->where('team','=', NULL)->get();

        return view('auth.team.list_user_to_invite')->with('user',$user);
    }

    public function user_team_index()
    {

        $user = DB::table('users')->where('id','LIKE',Auth::user()->id)->first();
        $totalMemberKosong = 0;
        $userTeam = $user->team;


        $team = DB::table('teams')->where('team_name','LIKE',$userTeam)->first();

        if($team->first_member_id == NULL)
        {
            $totalMemberKosong++;
        }

        if($team->second_member_id == NULL)
        {
            $totalMemberKosong++;
        }

        if($team->third_member_id == NULL)
        {
            $totalMemberKosong++;
        }

        if($team->forth_member_id == NULL)
        {
            $totalMemberKosong++;
        }

        return view('auth.team.user_team_index')->with('team',$team)->with('totalMemberKosong',$totalMemberKosong);
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


    public function user_accept_team_invitation($id,$mailId)
    {
        $unique_id = Auth::user()->unique_id;
        $sender_id = $id;

        $mail = DB::table('inboxes')->where('id','LIKE',$mailId)->first();

        // $teamPengirim  = DB::table('teams')->where('leader_id','LIKE',$sender_id)->first();
        // $teamname = $teamPengirim->team_name;
        // $teamID = $teamPengirim->id;

        // $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->first();

        if($mail->mail_type == "request_team")
        {
            $userYangMauMasukTeam = DB::table('users')->where('unique_id','LIKE',$sender_id)->first();

            $leaderTeamnya = DB::table('users')->where('unique_id','LIKE',$unique_id)->first();

            DB::table('inboxes')->where('id','LIKE',$mailId)->update(['mail_readed' => 'readed']);
            DB::table('users')->where('unique_id','LIKE',$sender_id)->update(['team_id' => $leaderTeamnya->team_id, 'team' => $leaderTeamnya->team]);

            return redirect()->back();
        }


        if($mail->mail_type == "invite_team")
        {
            $teamPengirim  = DB::table('teams')->where('leader_id','LIKE',$sender_id)->first();
            $teamname = $teamPengirim->team_name;
            $teamID = $teamPengirim->id;

            $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->first();
            if($userPenerima->team != NULL)
            {
                return redirect()->back()->with('status_team_user','You already in a team! cannot join any team anymore.');
            }
            else
            {
                DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team_id' => $teamID]);
                if($teamPengirim->first_member_id == NULL)
                {
                    DB::table('teams')->where('leader_id','LIKE',$sender_id)->update(['first_member_id' => $userPenerima->unique_id]);
                    $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team' => $teamname]);
                    DB::table('inboxes')->where('id','LIKE',$mailId)->update(['mail_readed' => 'readed']);
                }
                else if($teamPengirim->second_member_id == NULL)
                {
                    DB::table('teams')->where('leader_id','LIKE',$sender_id)->update(['second_member_id' => $userPenerima->unique_id]);
                    $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team' => $teamname]);
                    DB::table('inboxes')->where('id','LIKE',$mailId)->update(['mail_readed' => 'readed']);
                }
                else if($teamPengirim->third_member_id == NULL)
                {
                    DB::table('teams')->where('leader_id','LIKE',$sender_id)->update(['third_member_id' => $userPenerima->unique_id]);
                    $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team' => $teamname]);
                    DB::table('inboxes')->where('id','LIKE',$mailId)->update(['mail_readed' => 'readed']);
                }
                else if($teamPengirim->forth_member_id == NULL)
                {
                    DB::table('teams')->where('leader_id','LIKE',$sender_id)->update(['forth_member_id' => $userPenerima->unique_id]);
                    $userPenerima = DB::table('users')->where('unique_id','LIKE',$unique_id)->update(['team' => $teamname]);
                    DB::table('inboxes')->where('id','LIKE',$mailId)->update(['mail_readed' => 'readed']);
                }
                else
                {
                    return redirect()->back()->with('status','Sorry teams that you want to join is already in full roster!');
                }
            }
        }



        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
