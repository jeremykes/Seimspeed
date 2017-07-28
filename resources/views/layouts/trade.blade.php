<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/bootstrap-lumen.min.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/seimspeed.css') }}">

    @yield('css')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('41b9b7f7d7c0187461f6', {

            // If logged ok add the authEndpoint option
            @if (Auth::check())
                authEndpoint: "{{ url('/pusher/auth/' . Auth::user()->id) }}",
            @endif

            auth: {
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                    }
                },
            encrypted: true
        });

    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" data-count="7">
                                  <i class="fa fa-bell-o fa-stack-1x" style="color:white"></i>
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
                                  <i class="fa fa-envelope-o fa-stack-1x" style="color:white"></i>
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
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}" style="color:white">Login</a></li>
                            <li><a href="{{ route('register') }}" style="color:white">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color:white">
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

        <!-- Modals -->

        <!-- Status alert modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="statusModal">
          <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hey friend, just FYI...</h4>
              </div>
              <div class="modal-body" id="statudModalBody">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>



        <div class="container">
            
            <div class="col-md-1">
                    <!-- Left Column -->
            </div>

            <div class="col-md-8">
                    @yield('content')
            </div>

            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Advert 1
                    </div>
                    <div class="panel-body">
                        Advert 1 content
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Advert 2
                    </div>
                    <div class="panel-body">
                        Advert 2 content
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Advert 3
                    </div>
                    <div class="panel-body">
                        Advert 3 content
                    </div>
                </div>

            </div>

        </div>
        
    </div>

    <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/seimspeed.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('script')

</body>
</html>
