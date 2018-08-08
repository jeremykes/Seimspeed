<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/bootstrap-paper.min.css') }}" >
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" > -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/seimspeed.css') }}">

    <style type="text/css" media="screen">
        body {
            /*font-size: 12px;*/
        }
    </style>

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
            authEndpoint: "{{ url('/pusher/auth/' . Auth::user()->id) }}",
            auth: {
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                    }
                },
            encrypted: true
        });

        var privateUserChannel = pusher.subscribe('private-App.User.' + {{ Auth::user()->id }});

        privateUserChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
            BroadcastNotificationCreated(data);
        });

        // Globale variable for this page
        var friendUserID = 0;

        function BroadcastNotificationCreated(data) {
            if (data.type == 'App\\Notifications\\NewMessageNotification') {
                // getMessages();
                getNotifications();
                if (friendUserID > 0) {
                    $('#usermessages').html('');
                    getUserMessages(friendUserID);
                }
            } else { 
                getNotifications();
            }
        }

    </script>

    @yield('realtime')

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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        @if (Auth::check() && !(is_null(Auth::user()->corporateuser)))
                            @if (Auth::user()->corporateuser->corporate->exists())
                                <li><a href="{{ url('/corporate/' . Auth::user()->corporateuser->corporate->id . '/dashboard') }}"><span class="label label-danger"><i class="fa fa-at"></i> {{ Auth::user()->corporateuser->corporate->name }}</span></a></li>
                            @endif
                        @endif
                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" id="notificationCount">
                                  <i class="fa fa-bell-o fa-stack-1x"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu scrollable-menu" role="menu">
                                <li id="notificationList">

                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" id="messageCount">
                                  <i class="fa fa-envelope-o fa-stack-1x"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu scrollable-menu" role="menu">
                                <li id="messageList">

                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user') }}">Messages</a></li>
                                <li><a href="{{ url('/user/settings') }}">Settings</a></li>
                                <li role="separator" class="divider"></li>
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

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Status alert modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="statusModal">
          <div class="modal-dialog model-sm" role="document" style="top:40%">
            <div class="modal-content">
              <div class="modal-header" style="padding:0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-right:5px"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body" id="statusModalBody" style="text-align:center"></div>
            </div>
          </div>
        </div>


        <!-- New User Message modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="newusermessageModal">
            <div class="modal-dialog model-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding:0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-right:5px"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="newusermessageModalBody">
                        <p>Type a name...</p>
                        <p>
                            <input class="form-control" type="text" name="newuserpartial" id="newuserpartial">
                        </p>
                        <p>
                            <ul class="list-group" id="newUserList">
                                
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <div class="container">
            
            <div class="col-md-3">
                <h5 style="font-weight:bold;text-align:center">{{ $user->name }}</h5 style="font-weight:bold">
                <p><img src="{{ Auth::user()->propic }}" class="img-responsive"></p>

                @yield('menu')

                @if ($corporate_user_administrator == false)
                    <a href="{{ url('/user/corporate/add') }}" class="btn btn-primary" style="width:100%">Create corporate account</a>
                @endif

            </div>

            <div class="col-md-7">
                    @yield('content')
            </div>

            <div class="col-md-2">

                <!-- <div class="panel panel-default">
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
                </div> -->

            </div>

        </div>
        
    </div>

    <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/material.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/seimspeed.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script>

        var user_id = 0;
        var base_url = "{{ url('/') }}";

        getNotifications();

        // User ID
        var user_id = {{ Auth::user()->id }};

        @if (Auth::user()->hasRole('administrator'))
            var corp_user_role = 'administrator';
        @elseif (Auth::user()->hasRole('sales'))
            var corp_user_role = 'sales';
        @elseif (Auth::user()->hasRole('maintainer'))
            var corp_user_role = 'maintainer';
        @elseif (Auth::user()->hasRole('manager'))
            var corp_user_role = 'manager';
        @endif

        var timeArray = [];

        $('#newuserpartial').on('keyup', function() {
            if (this.value.length > 3) {
                getNewUsers(this.value);
            }
        });
    
    </script>

    @yield('script')

</body>
</html>
