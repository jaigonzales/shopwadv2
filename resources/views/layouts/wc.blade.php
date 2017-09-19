<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SEO Meta -->
    <meta name="description" content="Create and share your shoplist with your friends!"/>
    <meta name="keywords" content="shop, list, friends, share, shoplist, wishlist, app"/>
    <meta name="DC.title" content="Create and share your shoplist with your friends!"/>
    <!-- Facebook Graph -->

    <meta property="og:url" content="http://www.shopwad.com">

    <meta property="fb:app_id" content="229606804216824">
    <meta property="og:title" content="@yield('pageTitle') - Shop Wad">
    <meta property="og:description"
          content="Start creating and sharing your shopping lists with your friends. Register!">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://www.shopwad.com/images/sc/thumb.jpg">


    <title>{{ config('app.name', 'Shop Wad') }}</title>

    <!-- Styles -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style type="text/css">
        html, body{
            height: 100%;
        }
        .tag-line{
            font-weight: 700;
            color: #000;
            font-size: 4em;
        }
        .home-wd-title{
            font-size: 1.6em;
            font-weight: 700;
        }
        #welcomebg_id{
            width: 100%;
            overflow: hidden;
        }
        #welcomebg_id img{
            width: 100%;
            height: auto;
        }
        #homepage-slide{
            margin-top: 40px;
            position: relative;
        }
        #homepage-slide .content{
            height: inherit;
        }
        #homepage-dedatils{
            position: relative;
            z-index: 999;
            padding-top: 80px;
        }
        #homepage-details img{
            max-width: 500px;

        }
        .home-wid{
            float: left;
            margin: 12px;
            box-sizing: border-box;
            min-height: 400px;

            padding: 24px;
            text-align: center;
            background: #f3f3f3;
        }
        @media only screen and (max-width : 320px) {
            .tag-line{
                font-size: 2em;
            }
            #welcomebg{
                top: 282px;
                left: 0;
            }
            #welcomebg img {
                width: 200%;
                margin-left: -50%;
            }
        }
        @media only screen and (min-width : 320px) {
            .tag-line{
                font-size: 2em;
            }
            #welcomebg{
                top: 282px;
                left: 0;
            }
        }

        /* Extra Small Devices, Phones */
        @media only screen and (min-width : 480px) {
            .tag-line{
                font-size: 3em;
            }
            #welcomebg{
                top: 320px;
                left: 0;
            }
        }

        /* Small Devices, Tablets */
        @media only screen and (min-width : 768px) {
            .home-wid{
                width: calc(50% - 72px);
            }
            .tag-line{
                font-size: 3.4em;
            }
            #welcomebg{
                top: 280px;
                left: 0;
            }

        }

        @media only screen and ( min-width: 992px){
            .tag-line{
                font-size: 3.7em;
            }
            #welcomebg{
                top: 390px;
                left: 0;
            }
        }
        @media only screen and ( min-width: 1024px ){
            #welcomebg{
                top: 344px;
                left: 0;
            }
        }
        @media only screen and ( min-width: 1200px){
            #welcomebg{
                top: 214px;
                left: 0;
            }
        }
        @media only screen and ( min-width: 1440px){
            #welcomebg{
                top: 194px;
                left: 0;
            }
        }

    </style>

        <script>
            window.ShopWad = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>
</head>
<body>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '229606804216824',
            xfbml: true,
            version: 'v2.9'
        });
        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('sw_logo.svg')  }}" width="180" alt="{{ config('app.name', 'Shop Wad') }}"
                         title="{{ config('app.name', 'Shop Wad') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if ( !Auth::guest() )
                    <ul class="nav navbar-nav">
                        <form method="GET" action="search" enctype="multipart/form-data" class="navbar-form navbar-left">
                            &nbsp;<div class="input-group">
                                <input type="text" class="form-control" placeholder="Find friends..." name="q">
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-default" type="button">
                                    <i class="fa fa-search"aria-hidden="true"></i>
                                </button>
                            </span>
                            </div><!-- /input-group -->
                        </form>
                    </ul>
            @endif

            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li>
                            <a href="{{ route('home')  }}">
                                <strong>{{ Auth::user()->firstname }} {{ str_limit(Auth::user()->lastname, 1, ".") }}</strong>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fellows') }}">
                                Fellow Shoppers
                            </a>
                        </li>
                        <li>
                            @if ($totalFriendRequests >= 1)
                                <span class="notification notif-red notif-small">{{ $totalFriendRequests }}</span>
                            @endif
                            <a href="{{ route('fellow-requests') }}">
                                Requests
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account-settings') }}">Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <p>
            <a href="{{ route('policies') }}">Terms of use & Privacy Policy</a>
        </p>
        <p>&copy; Copyright Shop Wad 2017<br />
            All rights reserved</p>
    </footer>
</div>

<!-- Scripts -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/sweetalert2.min.js') }}"></script>
<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>


<script src="{{ asset('js/date.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
