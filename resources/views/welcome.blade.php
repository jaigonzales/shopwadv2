<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop Wad - The social app for sharing your shoplists with your friends!</title>
    <meta property="fb:app_id" content="229606804216824">
    <meta property="og:url" content="http://www.shopwad.com">
    <meta property="og:title" content="Shop Wad - The social app for sharing your shoplists with your friends!">
    <meta property="og:description" content="Start creating and sharing your shopping lists with your friends. Register!">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://www.shopwad.com/images/sc/thumb.jpg">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        .content{
            margin: 0 auto;
        }
        .slogan{
            font-size: 22px;
        }
        .links > a{
            color: #333;
            font-size: 24px;
            font-weight: 300;
            padding: 0 25px;
            text-decoration: none;
        }
        .links > a:hover{
            color: #66cc33;
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
        .m-b-md {
            margin-bottom: 30px;
        }
        footer{
            text-align: center;
        }
    </style>
</head>
<body>
@if (Route::has('login'))
    <div class="top-right links">
        @if (Auth::check())
            <a href="{{ url('/home') }}">Home</a>
        @endif
    </div>
@endif
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('sw_logo.svg')  }}" width="180" alt="{{ config('app.name', 'Shop Wad') }}" title="{{ config('app.name', 'Shop Wad') }}">
            </a>
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
                    <li><a href="{{ route('login') }}">Log in</a><li>
                    <li><a href="{{ route('register') }}">Create an Account</a></li>
                    {{-- <li><a href="{{ route('help') }}">Help</a></li> --}}
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <section id="homepage-slide">
        <div class="container" style="height: 100%">
            <div class="row">
                <div class="col-md-6">
                    <h1>Create and share your </br />shopping lists with your friends.</h1>
                    <br >
                    <h4>Save your favorite products to <br />your shopping list.</h4>
                    <br />
                    <a href="{{ route('login') }}" class="btn btn-lg btn-primary">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Create an Account</a>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section id="homepage-dedatils">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-paper-plane" aria-hidden="true"></i></h1>
                    <h3>Get Started</h3>
                    <p>Register and start creating your own shopping list and save your favorite products to your list.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-share-alt" aria-hidden="true"></i></h1>
                    <h3>Discover &amp; Share</h3>
                    <p>Let your friends discover what’s in your shopping list by sharing it. You can also choose the type of privacy for each lists.</test>
                </div>
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
                    <h3>Invite Friends</h3>
                    <p>Connect with your friends and other shoppers to discover what’s in their shopping list.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p>
            <a href="{{ route('policies') }}">Terms of use & Privacy Policy</a>
        </p>
        <p>&copy; Copyright Shop Wad 2017<br />
            All rights reserved</p>
    </footer>
</div>
</div>
</body>
</html>
