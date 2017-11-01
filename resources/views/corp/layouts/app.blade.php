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


    <style type="text/css" media="screen">
        body {
            font-size: 12px;
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

        /*
        |
        | 1. Subscribe to the channels and bind
        |
        */

        var privateUserChannel = pusher.subscribe('private-App.User.' + {{ Auth::user()->id }});

        privateUserChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
            BroadcastNotificationCreated(data);
        });
        
        function BroadcastNotificationCreated(data) {
            if (data.type == 'App\\Notifications\\NewMessageNotification') {
                // getMessages();
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
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        @if (Auth::check())
                            @if (Auth::user()->corporateuser->corporate->exists())
                                <li><a href="{{ url('/corporate/' . Auth::user()->corporateuser->corporate->id . '/dashboard') }}" style="color:white"><span class="label label-danger"><i class="fa fa-at"></i> {{ Auth::user()->corporateuser->corporate->name }}</span></a></li>
                            @endif
                        @endif

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack has-badge" id="notificationCount">
                                  <i class="fa fa-bell-o fa-stack-1x" style="color:white"></i>
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
                                  <i class="fa fa-envelope-o fa-stack-1x" style="color:white"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu scrollable-menu" role="menu">
                                <li id="messageList">

                                </li>
                            </ul>
                        </li>

                        <li></li>
                        <li></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white">
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

        <!-- Message modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="messageModal">
            <div class="modal-dialog model-lg" role="document">
                <div class="modal-content col-md-12">
                    <div class="modal-header" style="padding:0;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-right:5px"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" id="user-info"></div>
                        <div class="col-md-12" id="usermessages" style="height:450px;min-height:450px;overflow:scroll;padding-bottom:100px;">
                          
                        </div>
                        <div class="col-md-12" id="message_input" style="display:none">
                            <div class="bottom_wrapper">
                                <div class="message_input_wrapper">
                                    <input class="message_input" placeholder="Type..." />
                                </div>
                                <div class="send_message" onclick="sendMessage()">
                                    <div class="icon"></div>
                                    <div class="text">Send</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            
            <div class="col-md-2">
                <!-- <ul class="list-group">
                    <li class="list-group-item">Item 1</li>
                    <li class="list-group-item">Item 2</li>
                    <li class="list-group-item">Item 3</li>
                    <li class="list-group-item">Item 4</li>
                    <li class="list-group-item">Item 5</li>
                </ul> --> 
            </div>

            <div class="col-md-10">
            
                @yield('tabs')

                <div class="tab-content">

                    @yield('dashboard-tab')
                        <div class="panel panel-default col-md-12">
                            @yield('dashboard-content')
                        </div>
                    </div>
                    @yield('store-tab')
                        <div class="panel panel-default col-md-12">
                            @yield('store-content')
                        </div>
                    </div>
                    @yield('members-tab')
                        <div class="panel panel-default col-md-12">
                            @yield('members-content')
                        </div>
                    </div>
                    @yield('settings-tab')
                        <div class="panel panel-default col-md-12">
                            @yield('settings-content')
                        </div>
                    </div>
                </div>
                    
            </div>

        </div>
        
    </div>

    <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/seimspeed-corp.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script>

        var timeArray = [];

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
 
    </script>

    @yield('script')

</body>
</html>
