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
                    <a href="chart.html"><i class="fa fa-bar-chart-o"></i> Charts</a>
                </li>
                <li>
                    <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
                </li>

                <li>
                    <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
                </li>
                <li>
                    <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Second Level Link</a>
                        </li>
                        <li>
                            <a href="#">Second Level Link</a>
                        </li>
                        <li>
                            <a href="#">Second Level Link<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>

                            </ul>

                        </li>
                    </ul>
                </li>
                <li>
                    <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
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

                                <a href="" class="btn btn-warning">View User</a>


                                <!-- BUTTON TRIGGER MODAL DELETE USER -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{$users->id}}">
                                    Delete User
                                </button>
                            </td>

                        </tr>

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
                                        Unique ID : <strong>{{$users->unique_id}}</strong><br>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#confirmDeleteUser{{$users->id}}">Delete</button>
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

            </div>
        </div>


        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection
