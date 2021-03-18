@extends('layouts.adminLayouts')

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
                    <a href="{{route('admin.view_user')}}" id="userMenuSideBar" onclick="highlight_user_menu()"><i class="fa fa-user"></i> View User</a>
                </li>

                <li>
                    <a  class="active-menu" href="{{route('admin.banned_index')}}"> <i class="fa fa-ban"> </i> Banned User</a>
                </li>

                <li>
                    <a href="{{route('admin.report')}}"><i class="fa fa-edit"></i> User Reports</a>
                </li>



            </ul>

        </div>

    </nav>
     <!-- /. NAV SIDE  -->

 <div id="page-wrapper">
    <div id="page-inner">

        @php
            $userBanned = DB::table('users')->where('banned_until' , 'NOT LIKE' , NULL)->get();
            $number = 1;
        @endphp

        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header" style="text-align: center">
                    List Banned User
                </h1>

                <table class="table">
                    <thead class="thead-dark" style="background: black">
                      <tr style="color: whitesmoke">
                        <th scope="col">No.</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Banned Started</th>
                        <th scope="col">Banned Days Remaining</th>
                        <th scope="col">Action</th>
                      </tr>

                      <tbody>
                        @foreach ($userBanned as $userBanneds)
                        @php
                            $reportMilikUser = DB::table('reports')->where(['receiver_id' => $userBanneds->id],['validation' => 'checked'])->get();
                            $sisaHariBanned = Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($userBanneds->banned_until));
                        @endphp
                        <tr>
                            <td>{{$number}}</td>
                            <td>{{$userBanneds->id}}</td>

                            <td>
                                {{$userBanneds->name}}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($userBanneds->banned_started)->format('d/m/Y')}}
                            </td>

                            <td>
                                {{$sisaHariBanned}} Days Left
                            </td>

                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$userBanneds->id}}">
                                    Unban
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$userBanneds->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$userBanneds->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$userBanneds->id}}">Unbanned User : {{$userBanneds->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    Report Record

                                    @foreach ($reportMilikUser as $reportMilikUsers)

                                                <p style="color: red">
                                                    {{$reportMilikUsers->report}}
                                                </p>

                                    @endforeach
                                </div>
                                <div class="modal-footer" style="text-align: center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                <a href="{{route('admin.unban',$userBanneds->id)}}" type="button" class="btn btn-danger">
                                    Unban
                                </a>

                                </div>
                            </div>
                            </div>
                        </div>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    </tbody>

                    </thead>

                </table>
            </div>
        </div>



        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->

@endsection

