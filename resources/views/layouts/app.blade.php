<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('title')

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Libraries CSS Files -->
    <link href="{{asset('../lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('../lib/animate-css/animate.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- favicoon -->
    <link rel="shortout icon" type="image/png" href="{{ asset('../img/favicon-laravel-32x32.png') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                WorldNews
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('lang.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('lang.register') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('lang.home') }}</a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('article.create') }}" class="nav-link">{{ __('lang.create_article') }}</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('article.edit') }}" class="nav-link">{{ __('lang.edit_article') }}</a>--}}
{{--                        </li>--}}


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                    {{ __('lang.profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('config') }}">
                                    {{ __('lang.settings') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('lang.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <!--==========================
Footer
============================-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        Developed by: <a href="https://sites.google.com/fp.uoc.edu/grupo-jadf/presentaci%C3%B3n-del-proyecto" target="_blank"><strong>Grupo JDAF 2019 &copy;</strong></a>
                    </div>
                    <div class="credits">

                        <a href="https://sites.google.com/fp.uoc.edu/grupo-jadf/presentaci%C3%B3n-del-proyecto" target="_blank"><strong>Github</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</div>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- Required JavaScript Libraries -->
{{-- css/app.css --}}

<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib/superfish/hoverIntent.js') }}"></script>
<script src="{{ asset('lib/superfish/superfish.min.js') }}"></script>
<script src="{{ asset('lib/morphext/morphext.min.js') }}"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/stickyjs/sticky.js') }}"></script>
<script src="{{ asset('lib/easing/easing.js') }}"></script>



</body>
</html>
