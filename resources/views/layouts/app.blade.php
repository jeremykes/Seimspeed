<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('css/seimspeed.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


    </script>

    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
    <script src="{{ asset('js/seimspeed.js') }}"></script>

    @if (!Auth::guest())

        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('41b9b7f7d7c0187461f6', {
                authEndpoint: "{{ url('/pusher/auth/' . Auth::user()->id) }}",
                auth: {
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                        }
                    },
                encrypted: true
            });

            /*
            |
            | 1. Subscribe to the Channels
            |
            */

            // PRIVATE
            var privateUserChannel = pusher.subscribe('private-App.User.' + {{ Auth::user()->id }});

            // PUBLIC
            var publicChannel = pusher.subscribe('public-channel');

            // Bind the the Private Notification Event
            privateUserChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
                BroadcastNotificationCreated(data);
            });

            // Function for the Notification Events
            function BroadcastNotificationCreated(data) {
                if (data.type == 'App\\Notifications\\NewMessageNotification') {
                    if (data.user_sending_id == {{ Auth::user()->id }}) {
                        var sending_name = 'you';
                    } else {
                        var sending_name = data.user_sending_name;
                    }
                    $('#newsfeed').append('<div>'+sending_name+' - '+data.message+'<div><hr>');
                } else {
                    // NOTIFICATION APPENDING HAPPENS HERE
                }
            }

        </script>

    @endif

    @yield('realtime')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" data-count="7">
                                  <i class="fa fa-bell-o fa-stack-1x"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#">Noti 1</a>
                                    <a href="#">Noti 2</a>
                                    <a href="#">Noti 3</a>
                                    <a href="#">Noti 4</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" data-count="99">
                                  <i class="fa fa-envelope-o fa-stack-1x"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li id="message-list">
                                    <a href="#">Message 1</a>
                                    <a href="#">Message 2</a>
                                    <a href="#">Message 3</a>
                                    <a href="#">Message 4</a>
                                </li>
                            </ul>
                        </li>

                        <li></li>
                        <li></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        
    </div>

    <!-- Scripts -->
    <script src="js/app.js"></script>

    @yield('script')

</body>
</html>
