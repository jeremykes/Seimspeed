@extends('layouts.trade')

@section('css')
  <link href="{{ asset('css/lightslider/lightslider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<!-- Build initially with PHP -->

<!-- Later you update each element with JS -->

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">
            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                @foreach ($carauction->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->thumb_img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->thumb_img_url }}"/></a>
                    </li>

                @endforeach

                </ul>
            </div>
            <div class="col-md-9">

                <p>
                    <span style="text-decoration:bold;font-size:14px;color:gray">
                        <span id="carmake">{{ $carauction->car->make }}</span> 
                        <span id="carmodel">{{ $carauction->car->model }}</span>, 
                        <span id="carcolor">{{ $carauction->car->color }}</span>, 
                        <span id="cardrive"></span>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label label-danger" style="font-size:16px">auction</label>
                    <span class="pull-right">
                        <span style="font-size:20px" id="carprice">K{{ number_format($carauction->price, 2) }}</span>
                    </span>
                </p>
                <p id="cardetails">
                    Body type: <span style="font-weight:bold">{{ $carauction->car->bodytype }}</span>. 
                    Weight: <span style="font-weight:bold">{{ $carauction->car->weight }}</span>Kg's. 
                    Fuel Type: <span style="font-weight:bold">{{ $carauction->car->fueltype }}</span>. 
                    Transmission: <span style="font-weight:bold">{{ $carauction->car->transmissiontype }}</span>. 
                    Steering side: <span style="font-weight:bold">{{ $carauction->car->steeringside }}</span>. 
                    Location: <span style="font-weight:bold">{{ $carauction->car->physicallocation }}</span>. 
                    <br>
                    Start: <span style="font-weight:bold">{{ $carauction->startdate->diffForHumans() }}</span>. 
                    End: <span style="font-weight:bold">{{ $carauction->enddate->diffForHumans() }}</span>. 
                    <br>
                    <span class="label label-info">Start bid price</span>: <span style="font-weight:bold;font-size:16px">{{ $carauction->startbidprice }}</span>. 
                    <br>
                    <span style="font-size:11px;color:grey">{{ $carauction->car->note }}
                </p>
                <p id="carauctionsignup">
                    @if ($carauction->signuprequired == 0) 
                        <span class="label label-warning">Signup required</span> <span style="font-size:16px">{{ $carauction->signupfee }}</span>
                    @else
                        <span class="label label-warning">Signup not required</span>
                    @endif
                </p>
                <p id="carauctionnote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $carauction->note }}</span></p>
                
                @if ($carauction->group)
                    <p>In group <a href="#"><span class="label label-primary">go to group</span></a></p>
                @endif

            </div>

            <div class="col-md-12">
                <hr style="margin:10px">
                <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Bid</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12" id="list">

</div>
        
@endsection


@section('script')

<script src="{{ asset('js/lightslider/lightslider.min.js') }}"></script>
<script src="{{ asset('js/lightbox/lightbox.min.js') }}"></script>

<script>

    $(document).ready(function(e) {
        $('#lightSlider').lightSlider({
            gallery: false,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 3,
            autowidth: true,
            auto: true,
            pauseOnHover: true,
            speed: 1000,
            pause: 5000
        });

    });

    /*
    |
    | Some initial JS variables
    |
    */


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

    var publicCarTradeChannel = pusher.subscribe('public-channel.carauction.{{ $carauction->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarAuctionClosed', function(data) {
        CarAuctionClosedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReservePurchased', function(data) {
        CarAuctionBidReservePurchasedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserved', function(data) {
        CarAuctionBidReservedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserveCancelled', function(data) {
        CarAuctionBidReserveCancelledBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidAdded', function(data) {
        CarAuctionBidAddedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidCancelled', function(data) {
        CarAuctionBidCancelledBuildTrade(data);
    }); 

</script>

@endsection