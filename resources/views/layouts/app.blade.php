<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .comment-icon:hover + .c-textarea
        {
            background-color: red;
        }

        #dots:focus
        {
            outline: none !important;
        }

        .c-textarea
        {
            width: 100%;
            height: 45px;
            line-height: 40px;
        }

        .c-textarea:focus
        {
            outline: none !important;
            border-bottom: 1px solid #0095f6 !important;
        }

        .c-button
        {
            display: inline-block;
            background: transparent;
            border: 0;
            outline: none;
            height: 45px;
            color: #0095f6;
        }

        .c-button:focus
        {

        }

        .like-button
        {
            background-color: transparent; 
            border: 0;
        }

        .like-button:focus
        {
            outline: none;
        }

        .fachero:hover
        {
            transition: .3s;
            background-color: rgba(255, 0, 0, 0.6);
            color: #fff;
        }

        .avatar
        {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
        }
    
        .user-info
        {
            width: 30%;
            height: fit-content;
        }

        .user-info h1
        {
            font-weight: 300;
        }

        .user-info h2
        {
            font-size: 20px;
        }

        .posts
        {
            width: 100%;
        }

        .posts-container
        {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .post
        {
            width: 30%;
            min-width: 300px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('image.create') }}">Upload-image</a>
                            </li>
                            <li class="nav-item">
                                <div class="figure col-sm" style="max-width: 60px; max-height: 60px; margin-bottom: 0 !impotant; 
                                padding-right: 0;">
                                    <img src="{{ Auth::user()->get_avatar }}" class="img-fluid rounded-circle">
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nick }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu">

                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                        profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('user.edit', Auth::user()) }}">
                                        edit profile
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
    </div>
</body>
</html>
