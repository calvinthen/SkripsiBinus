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
                            <th scope="col">To</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mail as $mails)


                              <tr>
                                <th scope="row">{{$mails->id}}</th>
                                <td>{{$mails->sender_unique_id}}</td>
                                <td>{{$mails->receiver_unique_id}}</td>
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
                                        <h5 class="modal-title" id="readMailModal{{$mails->id}}">Mail title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>

                                        <div class="modal-body">
                                            {{$mails->body}}
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        <a href="{{url('user/inbox/accept_team_invitation/' . $mails->sender_unique_id . '/' . $mails->id)}}" class="btn btn-primary">
                                            Join Team
                                        </a>


                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL-->

                             @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
