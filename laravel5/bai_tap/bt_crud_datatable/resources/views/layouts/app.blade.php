<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        {{-- <base href="{{ asset('') }}"> --}}
        
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        <!-- Bootstrap CSS -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- Font Awesome CSS -->
        <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

        <!-- Custom CSS -->
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- BEGIN CSS for this page -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/dataTable_1_10_16/dataTables.bootstrap4.min.css')}}"/>
        <!-- END CSS for this page -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    </head>
    <body class="adminbody">
        <div id="main"> 
            <div class="headerbar">
                <!-- LOGO -->
                <div class="headerbar-left">
                    <a href="index.html" class="logo"><img alt="Logo" src="{{asset('assets/images/logo.png')}}" /> <span>Admin</span></a>
                </div>
                <nav class="navbar-custom">
                    <ul class="list-inline float-right mb-0">
                        <!-- help -->
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-question-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small>Help and Support</small></h5>
                                </div>
                                <!-- item-->
                                <a target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item">
                                    <p class="notify-details ml-0">
                                        <b>Do you want custom development to integrate this theme?</b>
                                        <span>Contact Us</span>
                                    </p>
                                </a>
                                <!-- item-->
                                <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro" class="dropdown-item notify-item">
                                    <p class="notify-details ml-0">
                                        <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                        <span>Try Pike Admin PRO</span>
                                    </p>
                                </a>
                                <!-- All-->
                                <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item notify-all">
                                    <i class="fa fa-link"></i> Visit Admin Website
                                </a>
                            </div>
                        </li>
                        
                        <!-- chat -->
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">12</span>Contact Messages</small></h5>
                                </div>
                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <p class="notify-details ml-0">
                                        <b>Jokn Doe</b>
                                        <span>New message received</span>
                                        <small class="text-muted">2 minutes ago</small>
                                    </p>
                                </a>
                                
                                
                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>
                            </div>
                        </li>
                        
                        <!-- message -->
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">5</span>Allerts</small></h5>
                                </div>
                                
                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="{{asset('assets/images/avatars/avatar2.png')}}" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>John Doe</b>
                                        <span>User registration</span>
                                        <small class="text-muted">3 minutes ago</small>
                                    </p>
                                </a>
                                
                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All Allerts
                                </a>
                            </div>
                        </li>
                        <!-- account -->
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                {{-- <img src="assets/images/avatars/" alt="Profile image" class="avatar-rounded"> --}}
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hello, </small> </h5>
                                </div>
                                <!-- item-->
                                <a href="pro-profile.html" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Profile</span>
                                </a>
                                <!-- item-->
                                <a href="logout" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off"></i> <span>Logout</span>
                                </a>
                                
                            </div>
                        </li>
                    </ul>
                    
                    <!-- menu button display menu tables -->
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
                            <i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Navigation -->
            
            <!-- Left Sidebar -->
            <div class="left main-sidebar">
                <div class="sidebar-inner leftscroll">
                    <div id="sidebar-menu">
                        
                        <ul>
                            <li class="submenu">
                                <a class="active" href="home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                            </li>
                            
                            <!-- table -->
                            <li class="submenu">
                                <a  href="#"><i class="fa fa-fw fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Basic Tables</a></li>
                                    <li><a href="#">Data Tables</a></li>
                                </ul>
                            </li>
                            
                         
                            <li class="submenu">
                                <a href="#"><i class="fa fa-fw fa-star"></i><span> Menu quản trị</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('mapping-list')}}">Quản lí cây nhóm</a></li>
                                    <li><a href="{{route('machine-list')}}">Quản lí máy</a></li>
                                    
                                </ul>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        
                        {{-- content --}}
                        @yield('content')
                        @yield('modal')
                    </div>
                    <!-- END content -->
                </div>

            </div>
                <!-- END content-page -->
            <footer class="footer">
                <span class="text-right">
                    Copyright <a target="_blank" href="#">Your Website</a>
                </span>
                <span class="float-right">
                    Powered by <a target="_blank" href=""><b>Bắc Admin</b></a>
                </span>
            </footer>
        </div>
       
        <!-- END main -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/pikeadmin.js')}}"></script>
        
        <script src="{{asset('assets/dataTable_1_10_16/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/dataTable_1_10_16/dataTables.bootstrap4.min.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        @stack('scripts')
        
        
            
        <!-- END Java Script for this page -->
    </body>
</html>