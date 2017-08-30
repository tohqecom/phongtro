<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rent a Car!</title>

    <!-- Styles -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .full-height {
            height: 100vh;
            background-color: #fff;
        }
        .border{
            border-color:rgba(99, 107, 111, 0.3) !important;
            border-width: 0 0 0px;
        }
        .grey-glow:focus{
            border-color: #636F6B;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgb(208, 210, 212);
        }
        .grey-button{
            color: #636F6B;
            background-color: white;
            border-color: rgba(99, 107, 111, 0.3);
        }
        .grey-button:hover{
            background-color:#636F6B;
            border-color: #636F6B;
        }

        a{
            color: #636F6B;
        }
        a:hover{
            color: #373e3b;
        }
        .li-padding{
            padding-top: 10px;
        }
        .li-padding li{

            padding-left: 20px;
        }
        h1{
            color:#636F6B;
        }
        .logout{
            padding-left:0px !important;
        }
    </style>
</head>
<body>
    <div class="full-height" id="app">
        <nav class="navbar navbar-default navbar-static-top border">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="glyphicon glyphicon-home"></span> Rent a Car!
                    </a>
                    <img src="{{URL::asset('/images/car32px.png')}}" alt="car-logo" style="padding-top:8px"/>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}" ><span class="glyphicon glyphicon-user"></span> Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>

                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}  <span class="glyphicon glyphicon-th-list"></span>
                                </a>

                                <ul class="dropdown-menu li-padding" role="menu">
                                    <li>
                                        <span class="glyphicon glyphicon-th"></span>  See
                                    </li>
                                    <li>
                                        <a href="/cars"
                                           onclick="event.preventDefault();
                                                     document.getElementById('cars-form').submit();">
                                            &emsp;Cars
                                        </a>
                                        <form id="cars-form" action="/cars" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('/rents',['id' => Auth::user()->id]) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('rents-form').submit();">
                                            &emsp;Your rents
                                        </a>
                                        <form id="rents-form" action="{{ route('/rents',['id' => Auth::user()->id]) }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-off"></span> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @if(Auth::user()->admin == true)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Admin Panel <span class="glyphicon glyphicon-list-alt"></span>
                                    </a>

                                    <ul class="dropdown-menu li-padding" role="menu">

                                        <li>
                                            <span class="glyphicon glyphicon-plus"></span>  Add
                                        </li>
                                        <li>
                                            <a href="{{ route('cars/add') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('add-form').submit();">
                                                &emsp;Car
                                            </a>
                                            <form id="add-form" action="{{ route('cars/add') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                        <li>
                                            <a href="{{ route('users/add') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('add-user-form').submit();">
                                                &emsp;User
                                            </a>
                                            <form id="add-user-form" action="{{ route('users/add') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                        <li>
                                            <span class="glyphicon glyphicon-cog"></span>  Edit
                                        </li>
                                        <li>
                                            <a href="{{ route('cars') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('admin-cars-form').submit();">
                                                &emsp;Cars
                                            </a>
                                            <form id="admin-cars-form" action="{{ route('cars') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                        <li>
                                            <a href="{{ route('users') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('admin-users-form').submit();">
                                                &emsp;Users
                                            </a>
                                            <form id="admin-users-form" action="{{ route('users') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                        <li>
                                            <a href="{{ route('rents') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('admin-rents-form').submit();">
                                                &emsp;Rents
                                            </a>
                                            <form id="admin-rents-form" action="{{ route('rents') }}" method="GET" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
