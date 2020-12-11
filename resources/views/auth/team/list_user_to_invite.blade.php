@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center">
                        <strong> <h2> List user with no team</h2></strong>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role Game</th>
                            <th scope="col">Interest</th>
                            <th scope="col">invite</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                                <tr>
                                  <th scope="row">{{$users->id}}</th>
                                  <td>{{$users->name}}</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                  <td>
                                    <a href="{{route('inbox.create_invitation_team',$users->unique_id)}}" class="btn btn-primary">
                                          Invite
                                      </a>
                                  </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
