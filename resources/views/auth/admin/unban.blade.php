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
                    <a href="{{route('admin.report')}}"><i class="fa fa-edit"></i> Review Report</a>
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
                    List User get Banned
                </h1>

                <table class="table">
                    <thead class="thead-dark" style="background: black">
                      <tr style="color: whitesmoke">
                        <th scope="col">No.</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Banned Days</th>
                        <th scope="col">Action</th>
                      </tr>

                      <tbody>
                        @foreach ($userBanned as $userBanneds)
                        <tr>
                            <td>{{$number}}</td>
                            <td>{{$userBanneds->id}}</td>

                            <td>
                                {{$userBanneds->name}}
                            </td>

                            <td>
                                {{$userBanneds->banned_until}}
                            </td>

                            <td>
                                <button class="btn btn-warning">
                                    Unban
                                </button>
                            </td>
                        </tr>

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

