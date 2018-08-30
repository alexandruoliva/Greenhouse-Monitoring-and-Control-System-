<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GMS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
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
            margin-bottom: 30px;
        }





    </style>
</head>
<body>

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">User Dashboard</a>
            @else
                <a href="{{ route('login') }}">User-Login</a>
                <a href="{{ route('register') }}">User-Register</a>
                @endauth
        </div>
    @endif



    <div class="content">
        <div class="title m-b-md">
            <span style="color:green">  Greenhouse Monitoring  and Control System 🌱</span>
        </div>
        <div class="container">
            <div row="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel">
                        @component('components.cine')
                        @endcomponent
                    </div>
                </div>
            </div>
            <br>

        </div>
        <div class="links">
            <a href={{ route('admin.login') }}>Admin-Login</a>
            <a href="https://github.com/alexandruoliva">Github</a>

        </div>
    </div>
</div>
</body>
</html>

