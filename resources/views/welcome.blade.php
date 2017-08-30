<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .welcome{
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 50px;
                height: 50px;
            }
            .login{
                width: 150px !important;

            }
            .little{
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())

                        <a href="{{ url('/cars') }}">Cars</a>
                        <a href="{{ route('/rents',['id' => Auth::user()->id]) }}">Your rents</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a href="{{ url('/login') }}"><span class="glyphicon glyphicon-user"></span> Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                @if (Auth::check())
                    <div class="title m-b-md welcome">
                        Welcome, {{Auth::user()->name}}
                    </div>
                @endif
                <a href="/cars"><img src="{{URL::asset('/images/car.png')}}" alt="car-logo"/></a>
                <div class="title m-b-md">
                    Rent a car!
                </div>
                @if (Auth::guest())
                <div class="title m-b-md little ">
                    Please log in or register to access car list.
                </div>
                @else
                    <div class="title m-b-md little ">
                        Click 'Cars' or an icon to see available cars.
                    </div>
                @endif;
                </div>
            </div>
        </div>
    </body>
</html>
