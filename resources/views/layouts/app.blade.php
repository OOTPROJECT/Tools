<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css"/>
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skin (Blue) -->
    <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css"/>
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Toastr -->
    <link href="{{ asset('/css/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- SweetAlert2 -->
    <link href="{{ asset('/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- datepicker Bootstrap cdn -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"
    type="text/css" rel="stylesheet">
    @yield('header-extra')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>K</b>M</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>King Math</b> Admin </span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>Profile</p>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ url(Auth::user()->image) }}" class="img-circle" alt="User Image"/>
                                    <p>
                                        {{ Auth::user()->firstname." ".Auth::user()->lastname }}
                                        <small>{{ Auth::user()->created_at->diffForHumans() }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout</a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url(Auth::user()->image) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->firstname." ".Auth::user()->lastname }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            @endif

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">นักเรียน</li>
                <!-- USE {{ Request::is('route-name*') ? 'active' : '' }} to dynamically set active tab -->
                <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a href="{{ url('studentReg') }}">
                    <i class="fa fa-child" aria-hidden="true"></i> <span>สมัครเรียน</span></a></li>
                    <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('studentInfo') }}">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>ข้อมูลนักเรียน</span></a></li>
                    <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('studentInfo') }}">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> <span>ซื้อคอร์สเรียน</span></a></li>
                        <!--<li class="{{ Request::is('admin*') ? 'active' : '' }}"><a href="{{ url('admin') }}"><i
                        class='fa fa-cogs'></i> <span>Admin Panel</span></a></li>-->
                        <li class="header">ครู</li>
                        <!-- USE {{ Request::is('route-name*') ? 'active' : '' }} to dynamically set active tab -->
                        <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a href="{{ url('teacherReg') }}">
                            <i class="fa fa-user" aria-hidden="true"></i> <span>สมัครสอนพิเศษ</span></a></li>
                            <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('teacherInfo') }}">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>ข้อมูลครู</span></a></li>
                                    <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('HireCal') }}">
                                        <i class="fa fa-calculator" aria-hidden="true"></i> <span>คำนวณค่าจ้างครู</span></a></li>
                                        <li class="header">คอร์สเรียน</li>
                                        <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a href="{{ url('ClassMgt') }}">
                                            <i class="fa fa-calendar" aria-hidden="true"></i> <span>ตารางเรียน</span></a></li>

                                        </ul><!-- /.sidebar-menu -->
                                    </section>
                                    <!-- /.sidebar -->
                                </aside>

                                <!-- Content Wrapper. Contains page content -->
                                <div class="content-wrapper">

                                    <!-- Content Header (Page header) -->
                                    <section class="content-header">
                                        <h1>
                                            @yield('contentheader_title', 'Page Header here')
                                            <small>@yield('contentheader_description')</small>
                                        </h1>
                                    </section>

                                    <!-- Main content -->
                                    <section class="content">
                                        <!-- Your Page Content Here -->
                                        @yield('main-content')
                                    </section><!-- /.content -->
                                </div><!-- /.content-wrapper -->

                                <!-- Control Sidebar -->
                                <aside class="control-sidebar control-sidebar-dark">
                                    <!-- Create the tabs -->
                                    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                                        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                                        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- Home tab content -->
                                        <div class="tab-pane active" id="control-sidebar-home-tab">
                                            <h3 class="control-sidebar-heading">Recent Activity</h3>
                                            <ul class='control-sidebar-menu'>
                                                <li>
                                                    <a href=''>
                                                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                                        <div class="menu-info">
                                                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                                            <p>Will be 23 on April 24th</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul><!-- /.control-sidebar-menu -->

                                            <h3 class="control-sidebar-heading">Tasks Progress</h3>
                                            <ul class='control-sidebar-menu'>
                                                <li>
                                                    <a href=''>
                                                        <h4 class="control-sidebar-subheading">
                                                            Custom Template Design
                                                            <span class="label label-danger pull-right">70%</span>
                                                        </h4>
                                                        <div class="progress progress-xxs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul><!-- /.control-sidebar-menu -->

                                        </div><!-- /.tab-pane -->
                                        <!-- Stats tab content -->
                                        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                                        <!-- Settings tab content -->
                                        <div class="tab-pane" id="control-sidebar-settings-tab">
                                            <form method="post">
                                                <h3 class="control-sidebar-heading">General Settings</h3>
                                                <div class="form-group">
                                                    <label class="control-sidebar-subheading">
                                                        Report panel usage
                                                        <input type="checkbox" class="pull-right" checked/>
                                                    </label>
                                                    <p>
                                                        Some information about this general settings option
                                                    </p>
                                                </div><!-- /.form-group -->
                                            </form>
                                        </div><!-- /.tab-pane -->
                                    </div>
                                </aside><!-- /.control-sidebar -->

                                <!-- Add the sidebar's background. This div must be placed
                                immediately after the control sidebar -->
                                <div class='control-sidebar-bg'></div>

                            </div><!-- ./wrapper -->

                            @include('layouts.partials.scripts')

                        </body>
                        </html>
