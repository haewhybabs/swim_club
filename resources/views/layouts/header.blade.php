<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Swimming Club</title>
    <meta name="description" content="Swimming Club">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">SWIMCLUB</a>
                {{-- <a class="navbar-brand hidden" href="./">SWIMCLUB</a> --}}
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                @php $roleId = auth()?->user()?->role_id @endphp
                
                {{-- Admin --}}
                @if($roleId ==1) 
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ URL::TO("dashboard") }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                        
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Parent</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="{{ URL::TO("admin/create-parent") }}">Create Parent</a></li>
                                {{-- <li><i class="fa fa-table"></i><a href="tables-data.html">View Parents info</a></li> --}}
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Coach</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="{{ URL::TO("admin/create-coach") }}">Create Coach</a></li>
                                {{-- <li><i class="fa fa-table"></i><a href="tables-data.html">View Coach</a></li> --}}
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Squad</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="{{ URL::TO("admin/create-squad") }}">Create Squad</a></li>
                                {{-- <li><i class="fa fa-table"></i><a href="tables-data.html">View Squad info</a></li> --}}
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="{{ URL::TO('race-performance') }}"> <i class="menu-icon fa fa-table"></i>Race Performance</a>
                            
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO('gala-event') }}"> <i class="menu-icon fa fa-table"></i>Gala Event</a>
                            
                        </li>
                        <li class="menu-item">
                            <a href="{{ URL::TO("logout") }}"> <i class="menu-icon fa fa-table"></i>Logout</a>
                        </li>

                        

                    </ul>

                {{-- Coaches --}}
                @elseif($roleId==2)
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ URL::TO("dashboard") }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                        <li class="menu-item">
                            <a href="{{ URL::TO('my-squad') }}"> <i class="menu-icon fa fa-table"></i>My Squad</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ URL::TO('race-performance') }}"> <i class="menu-icon fa fa-table"></i>Race Performance</a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO('gala-event') }}"> <i class="menu-icon fa fa-table"></i>Gala Event</a>
                            
                        </li>
                        <li class="menu-item">
                            <a href="{{ URL::TO("logout") }}"> <i class="menu-icon fa fa-table"></i>Logout</a>
                        </li>

                        

                    </ul>
                {{-- Swimmers --}}
                @elseif($roleId==3)
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ URL::TO("dashboard") }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
            
                        <li class="menu-item">
                            <a href="{{ URL::TO('load-info') }}"> <i class="menu-icon fa fa-table"></i>Personal Info</a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO('my-squad') }}"> <i class="menu-icon fa fa-table"></i>My Squad</a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO('my-parent') }}"> <i class="menu-icon fa fa-table"></i>My Parent</a>
                        </li>
                    
                        <li class="menu-item">
                            <a href="{{ URL::TO('race-performance') }}"> <i class="menu-icon fa fa-table"></i>Race Performance</a>
                            
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO('gala-event') }}"> <i class="menu-icon fa fa-table"></i>Gala Event</a>
                            
                        </li>

                        <li class="menu-item">
                            <a href="{{ URL::TO("logout") }}"> <i class="menu-icon fa fa-table"></i>Logout</a>
                        </li>

                        

                    </ul>
                {{-- Parents --}}
                @elseif($roleId==4)
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ URL::TO("dashboard") }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->

                    <li class="menu-item">
                        <a href="{{ URL::TO('load-info') }}"> <i class="menu-icon fa fa-table"></i>Child Info</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ URL::TO('my-parent') }}"> <i class="menu-icon fa fa-table"></i>Parent Info</a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ URL::TO('my-squad') }}"> <i class="menu-icon fa fa-table"></i>Child Squad</a>
                    </li>

            
                    <li class="menu-item">
                        <a href="{{ URL::TO('race-performance') }}"> <i class="menu-icon fa fa-table"></i>Race Performance</a>
                        
                    </li>

                    <li class="menu-item">
                        <a href="{{ URL::TO('gala-event') }}"> <i class="menu-icon fa fa-table"></i>Gala Event</a>
                        
                    </li>

                    <li class="menu-item">
                        <a href="{{ URL::TO("logout") }}"> <i class="menu-icon fa fa-table"></i>Logout</a>
                    </li>

                    

                </ul>
                @endif


            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> --}}
                        </a>
                    </div>
                </div>
            </div>
        </header>

    