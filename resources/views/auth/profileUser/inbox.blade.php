@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center"><Strong><h2>INBOX</h2></Strong></div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Inboxes ID</th>
                            <th scope="col">From</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mail as $mails)

                              @php
                                  $sender_name = DB::table('users')->where('id','LIKE',$mails->sender_id)->first();
                              @endphp

                              <tr>
                                <th scope="row">{{$mails->id}}</th>
                                <td>{{$sender_name->name}}</td>

                                @if ($mails->mail_type == "invite_team")
                                    <td>Team Invitation</td>

                                @elseif($mails->mail_type == "request_team")
                                    <td>Request Team</td>

                                @elseif($mails->mail_type == "request_friend")
                                    <td>Request Friend</td>
                                @endif


                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#readMailModal{{$mails->id}}">
                                        Read
                                    </button>
                                </td>
                              </tr>

                              <!-- Modal -->
                                <div class="modal fade" id="readMailModal{{$mails->id}}" tabindex="-1" role="dialog" aria-labelledby="readMailModal{{$mails->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="readMailModal{{$mails->id}}">
                                            @if ($mails->mail_type == "invite_team")
                                                <h5>Team Invitation</h5>
                                            @elseif($mails->mail_type == "request_team")
                                                <h5>Request team</h5>
                                            @elseif($mails->mail_type == "request_friend")
                                                <h5>Request Friend</h5>
                                            @endif
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>

                                        <div class="modal-body">
                                            {{$mails->body}}
                                        </div>

                                        <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}

                                        @if ($mails->mail_type == "request_friend")
                                            <a href="{{url('user/inbox/accept/friend/' . $mails->sender_id . '/' . $mails->id)}}" class="btn btn-primary">
                                                Accept as Friend
                                            </a>

                                            <a href="{{route('user.decline_friend',$mails->id)}}" class="btn btn-danger">
                                                Decline user
                                            </a>

                                        @elseif($mails->mail_type == "request_team")
                                            <a href="{{url('user/inbox/accept_team_invitation/' . $mails->sender_id . '/' . $mails->id)}}" class="btn btn-primary">
                                                Accept as member
                                            </a>

                                            <a href="" class="btn btn-danger">
                                                Decline user
                                            </a>
                                        @else
                                            <a href="{{url('user/inbox/accept_team_invitation/' . $mails->sender_id . '/' . $mails->id)}}" class="btn btn-primary">
                                                Join Team
                                            </a>

                                            <a href="" class="btn btn-danger">
                                                Decline Team
                                            </a>
                                        @endif




                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL-->

                             @endforeach
                        </tbody>
                      </table>

                        @if (session('status_team_user'))
                            <div class="alert alert-danger">
                                {{ session('status_team_user') }}
                            </div>
                        @endif

                        @if (session('status_friend_accepted'))
                            <div class="alert alert-success">
                                {{ session('status_friend_accepted') }}
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('status_decline_friend'))
                            <div class="alert alert-danger">
                                {{ session('status_decline_friend') }}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
