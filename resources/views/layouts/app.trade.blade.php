<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('css/seimspeed.css') }}">

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

        /*
        |
        | 1. Subscribe to the channels and bind
        |
        */

        @if (Auth::check())
            var privateUserChannel = pusher.subscribe('private-App.User.' + {{ Auth::user()->id }});

            privateUserChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
                BroadcastNotificationCreated(data);
            });

            function BroadcastNotificationCreated(data) {
                if (data.type == 'App\\Notifications\\NewMessageNotification') {
                    // New Message Notification appending happens here.
                } else { 
                    // Notification appending happens here.
                }
            }

        @endif

        var publicChannel = pusher.subscribe('public-channel');

        @if (fnmatch('*/carsale/*', Request::path()) )

            var publicChannel = pusher.subscribe('public-channel.carsale.{{ $carsale->id }}');

            publicChannel.bind('App\\Events\\CarSaleClosed', CarSaleClosedBuild(data)); 
            publicChannel.bind('App\\Events\\CarSaleOfferReservePurchased', CarSaleOfferReservePurchasedBuild(data)); 
            publicChannel.bind('App\\Events\\CarSaleOfferReserved', CarSaleOfferReservedBuild(data)); 
            publicChannel.bind('App\\Events\\CarSaleOfferReserveCancelled', CarSaleOfferReserveCancelledBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentAdded', CarCommentAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentUpdated', CarCommentUpdatedBuild(data)); 
            publicChannel.bind('App\\Events\\CarSaleOfferAdded', CarSaleOfferAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarSaleOfferCancelled', CarSaleOfferCancelledBuild(data)); 

        @elseif (fnmatch('*/carrent/*', Request::path()) )

            var publicChannel = pusher.subscribe('public-channel.carrent.{{ $carrent->id }}');

            publicChannel.bind('App\\Events\\CarRentClosed', CarRentClosedBuild(data)); 
            publicChannel.bind('App\\Events\\CarRentOfferReservePurchased', CarRentOfferReservePurchasedBuild(data)); 
            publicChannel.bind('App\\Events\\CarRentOfferReserved', CarRentOfferReservedBuild(data)); 
            publicChannel.bind('App\\Events\\CarRentOfferReserveCancelled', CarRentOfferReserveCancelledBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentAdded', CarCommentAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentUpdated', CarCommentUpdatedBuild(data)); 
            publicChannel.bind('App\\Events\\CarRentOfferAdded', CarRentOfferAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarRentOfferCancelled', CarRentOfferCancelledBuild(data)); 

        @elseif (fnmatch('*/cartender/*', Request::path()) )

            var publicChannel = pusher.subscribe('public-channel.cartender.{{ $cartender->id }}');

            publicChannel.bind('App\\Events\\CarTenderClosed', CarTenderClosedBuild(data)); 
            publicChannel.bind('App\\Events\\CarTenderTenderReservePurchased', CarTenderTenderReservePurchasedBuild(data)); 
            publicChannel.bind('App\\Events\\CarTenderTenderReserved', CarTenderTenderReservedBuild(data)); 
            publicChannel.bind('App\\Events\\CarTenderTenderReserveCancelled', CarTenderTenderReserveCancelledBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentAdded', CarCommentAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentUpdated', CarCommentUpdatedBuild(data)); 
            publicChannel.bind('App\\Events\\CarTenderTenderAdded', CarTenderTenderAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarTenderTenderCancelled', CarTenderTenderCancelledBuild(data));  

        @elseif (fnmatch('*/carauction/*', Request::path()) )

            ar publicChannel = pusher.subscribe('public-channel.carauction.{{ $carauction->id }}');

            publicChannel.bind('App\\Events\\CarAuctionClosed', CarAuctionClosedBuild(data)); 
            publicChannel.bind('App\\Events\\CarAuctionBidReservePurchased', CarAuctionBidReservePurchasedBuild(data)); 
            publicChannel.bind('App\\Events\\CarAuctionBidReserved', CarAuctionBidReservedBuild(data)); 
            publicChannel.bind('App\\Events\\CarAuctionBidReserveCancelled', CarAuctionBidReserveCancelledBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentAdded', CarCommentAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarCommentUpdated', CarCommentUpdatedBuild(data)); 
            publicChannel.bind('App\\Events\\CarAuctionBidAdded', CarAuctionBidAddedBuild(data)); 
            publicChannel.bind('App\\Events\\CarAuctionBidCancelled', CarAuctionBidCancelledBuild(data)); 

        @elseif (fnmatch('*/partsale/*', Request::path()) )

            var publicChannel = pusher.subscribe('public-channel.partsale.{{ $partsale->id }}');

            publicChannel.bind('App\\Events\\PartSaleClosed', PartSaleClosedBuild(data)); 
            publicChannel.bind('App\\Events\\PartSaleOfferReservePurchased', PartSaleOfferReservePurchasedBuild(data)); 
            publicChannel.bind('App\\Events\\PartSaleOfferReserved', PartSaleOfferReservedBuild(data)); 
            publicChannel.bind('App\\Events\\PartSaleOfferReserveCancelled', PartSaleOfferReserveCancelledBuild(data)); 
            publicChannel.bind('App\\Events\\PartCommentAdded', PartCommentAddedBuild(data)); 
            publicChannel.bind('App\\Events\\PartCommentUpdated', PartCommentUpdatedBuild(data)); 
            publicChannel.bind('App\\Events\\PartSaleOfferAdded', PartSaleOfferAddedBuild(data)); 
            publicChannel.bind('App\\Events\\PartSaleOfferCancelled', PartSaleOfferCancelledBuild(data)); 

        @endif

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

        <div class="container">
            
            <div class="col-md-2">
                    <!-- Left Column -->
            </div>

            <div class="col-md-8">
                    @yield('content')
            </div>

            <div class="col-md-2">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            Advert 1
                        </div>
                        <div class="panel-body">
                            Advert 1 content
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            Advert 2
                        </div>
                        <div class="panel-body">
                            Advert 2 content
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel">
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
        
    </div>

    <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/seimspeed.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('script')

</body>
</html>
