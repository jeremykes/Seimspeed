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

                @foreach ($carrent->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->thumb_img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->thumb_img_url }}"/></a>
                    </li>

                @endforeach

                </ul>
            </div>
            <div class="col-md-9">

                <p>
                    <span style="text-decoration:bold;font-size:14px;color:gray">
                        <span id="carmake">{{ $carrent->car->make }}</span> 
                        <span id="carmodel">{{ $carrent->car->model }}</span>, 
                        <span id="carcolor">{{ $carrent->car->color }}</span>, 
                        <span id="cardrive"></span>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label label-danger" style="font-size:16px">rent</label>
                    <span class="pull-right">
                        <span style="font-size:20px" id="carprice">
                            K{{ number_format($carrent->price, 2) }}
                        </span>
                    </span>
                </p>
                <p id="cardetails">
                    Body type: <span style="font-weight:bold">{{ $carrent->car->bodytype }}</span>. 
                    Weight: <span style="font-weight:bold">{{ $carrent->car->weight }}</span>Kg's. 
                    Fuel Type: <span style="font-weight:bold">{{ $carrent->car->fueltype }}</span>. 
                    Transmission: <span style="font-weight:bold">{{ $carrent->car->transmissiontype }}</span>. 
                    Steering side: <span style="font-weight:bold">{{ $carrent->car->steeringside }}</span>. 
                    Location: <span style="font-weight:bold">{{ $carrent->car->physicallocation }}</span>. 
                    <br>
                    Rate/hour: <span style="font-weight:bold">{{ number_format($carrent->rateperhour, 2) }}</span>. 
                    Rate/day: <span style="font-weight:bold">{{ number_format($carrent->rateperday, 2) }}</span>.
                    <br> 
                    Bond fee: <span style="font-weight:bold">{{ number_format($carrent->bondfee, 2) }}</span>. 
                    <br>
                    <span style="font-size:11px;color:grey">{{ $carrent->car->note }}
                </p>
                <p id="carrentnote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $carrent->note }}</span></p>

            </div>

            <div class="col-md-12">
                <hr style="margin:10px">
                <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Offer</a>
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

    var publicCarTradeChannel = pusher.subscribe('public-channel.carrent.{{ $carrent->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarRentClosed', function(data) {
    	CarRentClosedBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReservePurchased', function(data) {
    	CarRentOfferReservePurchasedBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReserved', function(data) {
    	CarRentOfferReservedBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReserveCancelled', function(data) {
    	CarRentOfferReserveCancelledBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
    	CarCommentAddedBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferAdded', function(data) {
    	CarRentOfferAddedBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferCancelled', function(data) {
    	CarRentOfferCancelledBuildTrade(data);
    });

</script>

@endsection