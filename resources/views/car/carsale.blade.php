@extends('layouts.trade')

@section('css')
  <link href="{{ asset('css/lightslider/lightslider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">
            <div class="col-md-4" id="car_images">
                <ul id="lightSlider">

                @foreach ($carsale->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->thumb_img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->thumb_img_url }}"/></a>
                    </li>

                @endforeach

                </ul>
            </div>
            <div class="col-md-8">

                <p>
                    <span style="text-decoration:bold;font-size:14px;color:gray">
                        <span id="carmake">{{ $carsale->car->make }}</span> 
                        <span id="carmodel">{{ $carsale->car->model }}</span>, 
                        <span id="carcolor">{{ $carsale->car->color }}</span>, 
                        <span id="cardrive"></span>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label label-danger" style="font-size:16px">sale</label>
                    <span class="pull-right">
                        <span style="font-size:20px" id="carprice">K{{ number_format($carsale->price, 2) }}</span>
                    </span>
                </p>
                <p id="carsale_created_at{{ $carsale->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                <p id="cardetails">
                    Body type: <span style="font-weight:bold">{{ $carsale->car->bodytype }}</span>. 
                    Weight: <span style="font-weight:bold">{{ $carsale->car->weight }}</span>Kg's. 
                    Fuel Type: <span style="font-weight:bold">{{ $carsale->car->fueltype }}</span>. 
                    Transmission: <span style="font-weight:bold">{{ $carsale->car->transmissiontype }}</span>. 
                    Steering side: <span style="font-weight:bold">{{ $carsale->car->steeringside }}</span>. 
                    Location: <span style="font-weight:bold">{{ $carsale->car->physicallocation }}</span>. 
                    <br>
                    <span style="font-size:11px;color:grey">{{ $carsale->car->note }}
                </p>
                <p id="carsalenegotiable">
                    @if ($carsale->negotiable == 0) 
                        <span class="label label-warning">Negotiable</span>
                    @else
                        <span class="label label-warning">Not negotiable</span>
                    @endif
                </p>
                <p id="carsalenote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $carsale->note }}</span></p>
                
                @if ($carsale->group)
                    <p>In group <a href="#"><span class="label label-primary">go to group</span></a></p>
                @endif

            </div>

            <div class="col-md-12">
                <hr style="margin:10px">
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarSaleOffers({{ $carsale->car->id }});"><i class="fa fa-money"></i> Offer</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarComments({{ $carsale->car->id }});"><i class="fa fa-comment"></i> Comment</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTails({{ $carsale->car->id }});"><i class="fa fa-eye"></i> Tail</a>
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

    /*
    |
    | Some initial JS variables
    |
    */
    var reserves_count = 0;
    @if (Auth::check())
        @if (Auth::user()->hasRole('administrator'))
            var corp_user_role = 'administrator';
        @elseif (Auth::user()->hasRole('sales'))
            var corp_user_role = 'sales';
        @elseif (Auth::user()->hasRole('maintainer'))
            var corp_user_role = 'maintainer';
        @elseif (Auth::user()->hasRole('manager'))
            var corp_user_role = 'manager';
        @endif
    @endif
    var timeArray = [];
    var base_url = "{{ url('/') }}";

    /*
    |
    | Execute initial scripts when document is ready
    |
    */
    $(document).ready(function(e) {

        // Set carsale_created_at timestamp
        timeArray.push(['carsale_created_at{{ $carsale->car->id }}', '{{ $carsale->created_at }}']);

        // Initialize small slider of car images
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

        // Moment.js script to update all timestamps on the page
        updateTimestamps();
        window.setInterval(function(){
            updateTimestamps();
        }, 60000);

        getCarSaleOffers({{ $carsale->car->id }});

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

    var publicCarTradeChannel = pusher.subscribe('public-channel.carsale.{{ $carsale->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarSaleClosed', function(data) {
    	CarSaleClosedBuildTrade(data); 
    });
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReservePurchased', function(data) {
    	CarSaleOfferReservePurchasedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReserved', function(data) {
    	CarSaleOfferReservedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReserveCancelled', function(data) {
    	CarSaleOfferReserveCancelledBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
    	CarCommentAddedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferAdded', function(data) {
    	CarSaleOfferAddedBuildTrade(data);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferCancelled', function(data) {
    	CarSaleOfferCancelledBuildTrade(data);
    }); 

</script>

@endsection