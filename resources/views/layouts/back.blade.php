<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,300italic,400italic|Roboto+Condensed:400,300,400italic,300italic|Open+Sans:400,300,300italic,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('assets/bootstrap-treeview/dist/bootstrap-treeview.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/ion.rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('assets/ion.rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('assets/blueimp-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet">
    <link href="{{asset('assets/styles.css')}}" rel="stylesheet">

    <!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.0.8/es5-shim.min.js"></script><![endif]-->

</head>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="/dashboard" class="navbar-brand">Admin Panel</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            @if(Auth::guest())
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
            @endif
        </ul>
    </div>
</nav>

<div class="container-fluid">
    @yield('content')
</div>
<!-- jQuery first, then Bootstrap JS. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('assets/bootstrap-treeview/dist/bootstrap-treeview.min.js')}}"></script>
<script src="{{asset('assets/ion.rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/blueimp-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/blueimp-file-upload/js/jquery.fileupload.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="{{asset('assets/bootbox.js/bootbox.js')}}"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script src="{{asset('assets/dashboard.js')}}"></script>
</body>
</html>