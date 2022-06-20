<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/cropped-logo_fluxotelecom.png') }}" />

    <title> Adrian API- Hacker News</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
    html,
    body {
        background-color: #9fff;
        color: #63fb6f;
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

    .links>a {
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
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <img src="" alt="logo">
            </div>


            <h2 style="color:red">EndPoints:</h2>
            <div class="links">
                <a href="{{ route('api.tops') }}" target="_blank">Top Stories</a>
                <a href="{{ route('api.bests') }}" target="_blank">Best Stories</a>
                <a href="{{ route('api.lastweekdata') }}" target="_blank">Last Week Data</a>
                <a href="{{ route('api.karma.userstories') }}" target="_blank">Last 600 UserStories</a>
                <a href="{{ route('api.laststories') }}" target="_blank">Last Stories</a>
                <a href="{{ route('api.news') }}" target="_blank">News Stories</a>
                <a href="https://github.com/sheerikie/tradepoint" target="_blank">GitHub</a>
                <a href="https://supercooladrianthedev.netlify.app/" target="_blank">Adrian</a>
            </div> <br>

            <h3 style="color:yellow">Others:</h3>
            <div class="links">
                <a href="/api/user/JeffCyr" target="_blank">Get User</a>
                <a href="/api/item/17789026" target="_blank">Get Item Id</a>

            </div>
        </div>
    </div>
</body>

</html>
