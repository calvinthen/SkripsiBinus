<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Styles-->
    <link rel="stylesheet" href="{{asset('css/adminTemplate/css/bootstrap.css')}}">

    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="{{ asset('css/adminTemplate/css/font-awesome.css') }}">

    <!-- Morris Chart Styles-->
    <link rel="stylesheet" href="{{ asset('css/adminTemplate/js/morris/morris-0.4.3.min.css') }}">

    <!-- Custom Styles-->
    <link rel="stylesheet" href="{{ asset('css/adminTemplate/css/custom-styles.css') }}">



    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="{{route('home')}}"><i class="fa fa-home"></i> <strong> Home </strong></a>
            </div>
        </nav>
        <!--/. NAV TOP  -->

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <!-- /. WRAPPER  -->


    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{ asset('css/adminTemplate/js/jquery-1.10.2.js') }}"></script>

    <!-- Bootstrap Js -->
    <script src="{{ asset('css/adminTemplate/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Js -->
    <script src="{{ asset('css/adminTemplate/js/jquery.metisMenu.js') }}"></script>

    <!-- Morris Chart Js -->
    <script src="{{ asset('css/adminTemplate/js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('css/adminTemplate/js/morris/morris.js') }}"></script>

    <script src="{{ asset('css/adminTemplate/js/easypiechart.js') }}"></script>
    <script src="{{ asset('css/adminTemplate/js/easypiechart-data.js') }}"></script>


    <!-- Custom Js -->
    <script src="{{ asset('css/adminTemplate/js/custom-scripts.js') }}"></script>


</body>

</html>
