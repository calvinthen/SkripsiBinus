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
                    <a class="" href="{{route('admin.view_user')}}" id="userMenuSideBar" onclick="highlight_user_menu()"><i class="fa fa-user"></i> View User</a>
                </li>

                <li>
                    <a href="{{route('admin.report')}}" class="active-menu"><i class="fa fa-edit"></i> Review Report</a>
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
                    Report List <small></small>
                </h1>

                <table class="table">
                    <thead class="thead-dark" style="background: black">
                        <tr style="color: whitesmoke">
                          <th scope="col">No.</th>
                          <th scope="col">Report ID</th>
                          <th scope="col">User reported</th>
                          <th scope="col">Report by</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>

                      <tbody>
                          @foreach ($report as $reports)
                            @php
                                $userYangKenaReport = DB::table('users')->where('id','LIKE',$reports->receiver_id)->first();
                                $userYangReport = DB::table('users')->where('id','LIKE',$reports->reporter_id)->first();

                            @endphp
                            <tr>
                                <td>
                                    {{$number}}
                                </td>

                                <td>
                                    {{$reports->id}}
                                </td>

                                <td>
                                    {{$userYangKenaReport->name}}
                                </td>

                                <td>
                                    {{$userYangReport->name}}
                                </td>

                                <td>
                                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#ReportModal{{$reports->id}}">View Report</a>
                                </td>
                            </tr>

                             <!-- MODAL FOR DELETE USER -->
                             <div class="modal fade" id="ReportModal{{$reports->id}}" tabindex="-1" role="dialog" aria-labelledby="ReportModal{{$reports->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="ReportModal{{$reports->id}}Label"> Report ID : <strong>{{$reports->id}}</strong></h3>
                                    </div>
                                    <div class="modal-body">
                                        <strong> Reason : </strong>{{$reports->report}}

                                        <br><br>
                                        <strong>Status :</strong>
                                        @if ($reports->validation == "not_checked")
                                            <p style="color: red">
                                                Not Confirm
                                            </p>
                                        @elseif($reports->validation == "checked")
                                            <p style="color: green">
                                                Confirm
                                            </p>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <a href="{{route('admin.confirm_report',$reports->id)}}" type="button" class="btn btn-success">

                                        Accept report

                                    </a>

                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- END OF MODAL FOR DELETE USER -->


                            @php
                                $number++;
                            @endphp
                          @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
