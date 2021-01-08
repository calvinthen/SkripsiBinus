@extends('layouts.adminLayouts')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>


<!-- Styles -->



@section('content')

<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">

                <li>
                    <a href="{{route('admin.index')}}" id="dashboardMenuSideBar"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a class="active-menu" href="{{route('admin.view_user')}}" id="userMenuSideBar" onclick="highlight_user_menu()"><i class="fa fa-user"></i> View User</a>
                </li>

                <li>
                    <a href="{{route('admin.report')}}"><i class="fa fa-edit"></i> Review Report</a>
                </li>

            </ul>

        </div>

    </nav>
     <!-- /. NAV SIDE  -->

<div id="page-wrapper">
    <div id="page-inner">

        <!-- INISIALISASI PHP VARIABLE -->
        @php
            $number = 1;
        @endphp
        <!-- -->

        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header" style="text-align: center">
                    View list user <small></small>
                </h1>

                <table class="table">
                    <thead class="thead-dark" style="background: black">
                      <tr style="color: whitesmoke">
                        <th scope="col">No.</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Team</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach ($user as $users)

                        @php
                            $reportMilikUser = DB::table('reports')->where(['receiver_id' => $users->id],['validation' => 'checked'])->get();
                            $totalReportUserMiliki = DB::table('reports')->where(['receiver_id' => $users->id],['validation' => 'checked'])->count();
                        @endphp

                        <tr>
                            <td>
                                {{$number}}
                            </td>

                            <td>
                                {{$users->id}}
                            </td>

                            <td>
                                {{$users->name}}
                            </td>

                            <td>
                                {{$users->team}}
                            </td>

                            <td>


                                <!-- BUTTON TRIGGER MODAL view USER -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#viewUser{{$users->id}}">
                                    View User
                                </button>


                                <!-- BUTTON TRIGGER MODAL DELETE USER -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{$users->id}}">
                                    Delete User
                                </button>
                            </td>

                        </tr>

                             <!-- MODAL FOR VIEW USER -->
                             <div class="modal fade" id="viewUser{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="viewUser{{$users->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="viewUser{{$users->id}}Label"> Info of user ID : <strong>{{$users->id}}</strong></h3>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{url('./images/' . $users->photo_profile)}}" alt="" width="150px" height="150px"><br><br>
                                        Username : <strong>{{$users->name}}</strong><br>
                                        Email : <strong>{{$users->email}}</strong> <br>
                                        Game ID : <strong>{{$users->ingame_id}}</strong><br>
                                        Total Report :  {{$totalReportUserMiliki}}<br>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#confirmBanUser{{$users->id}}">Ban</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- END OF MODAL FOR VIEW USER -->

                        <form action="{{route('admin.banned_user',$users->id)}}" method="GET">
                            @csrf
                            <!-- MODAL FOR BAN USER -->
                            <div class="modal fade" id="confirmBanUser{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmBanUser{{$users->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-body" style="text-align: center">
                                    Are you sure want to ban user name <strong>{{$users->name}}</strong> with an ID of <strong>{{$users->id}}</strong><br><br>
                                    Report Record : <br>

                                        @if ($totalReportUserMiliki == 0)
                                            <p style="color: green">
                                                This player never been reported
                                            </p>

                                        @else
                                            @foreach ($reportMilikUser as $reportMilikUsers)

                                                <p style="color: red">
                                                    {{$reportMilikUsers->report}}
                                                </p>
                                                <br>
                                            @endforeach
                                        @endif

                                          <div class="form-group">
                                                <label for="banned">Banned Days Select : </label>
                                                <select class="form-control" id="banned" name="banned">
                                                <option value="3">3 Days</option>
                                                <option value="7">7 Days</option>
                                                <option value="14">14 Days</option>
                                                <option value="30">30 Days</option>
                                                </select>
                                          </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-danger" type="submit">
                                                Yes
                                            </button>
                                        </div>

                                        <div class="col-md-6">
                                            <button class="btn btn-primary" data-dismiss="modal">
                                                No
                                            </button>
                                        </div>
                                    </div>


                                    </div>

                                </div>
                                </div>
                            </div>
                            <!-- END OF MODAL BAN USER -->
                        </form>


                            <!-- MODAL FOR DELETE USER -->
                            <div class="modal fade" id="deleteUserModal{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal{{$users->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="deleteUserModal{{$users->id}}Label"> Info of user ID : <strong>{{$users->id}}</strong></h3>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{url('./images/' . $users->photo_profile)}}" alt="" width="150px" height="150px"><br><br>
                                        Username : <strong>{{$users->name}}</strong><br>
                                        Email : <strong>{{$users->email}}</strong> <br>
                                        Game ID : <strong>{{$users->ingame_id}}</strong><br>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#confirmDeleteUser{{$users->id}}">Delete user</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- END OF MODAL FOR DELETE USER -->


                            <!-- MODAL FOR CONFIRM DELETE USER -->
                            <div class="modal fade" id="confirmDeleteUser{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteUser{{$users->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-body" style="text-align: center">
                                    Are you sure want to delete user name <strong>{{$users->name}}</strong> with an ID of <strong>{{$users->id}}</strong><br><br>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <a href="{{route('admin.delete_user_now',$users->id)}}" class="btn btn-danger" type="button">
                                                    Yes
                                                </a>
                                        </div>

                                        <div class="col-md-6">
                                            <button class="btn btn-primary" data-dismiss="modal">
                                                No
                                            </button>
                                        </div>
                                    </div>


                                    </div>

                                </div>
                                </div>
                            </div>



                        @php
                            $number++;
                        @endphp

                      @endforeach

                    </tbody>
                  </table>

                        @if (session('banned_status'))
                            <div class="alert alert-danger">
                                {{ session('banned_status') }}
                            </div>
                        @endif

            </div>
        </div>


        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection
