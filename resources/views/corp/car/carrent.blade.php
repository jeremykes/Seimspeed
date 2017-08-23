@extends('corp.layouts.app')

@section('css')
  <link href="{{ asset('css/lightslider/lightslider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('datatables/datatables.css') }}" rel="stylesheet">
@endsection


@section('realtime')

<script>

    var corporateID = {{ $corporate->id }};

    /*
    |
    | 1. Subscribe to the channels and bind
    |
    */

    var publicCarTradeChannel = pusher.subscribe('public-channel.car.{{ $carrent->car->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarRentClosed', function(data) {
        CarRentClosedBuildTrade(data.carrent[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReservePurchased', function(data) {
        CarRentOfferReservePurchasedBuildTrade(data.carrent[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReserved', function(data) {
        CarRentOfferReservedBuildTrade(data.carrentreserve);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReserveCancelled', function(data) {
        CarRentOfferReserveCancelledBuildTrade(data);
    });
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data.carcomment[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferAdded', function(data) {
        CarRentOfferAddedBuildTrade(data.carrentoffer[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferCancelled', function(data) {
        CarRentOfferCancelledBuildTrade(data.carrentoffer);
    });

</script>

@endsection


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection


@section('dashboard-tab')
<div role="tab-panel" class="tab-pane" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane active" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane" id="settings">
@endsection


@section('store-content')
<div class="col-md-12"><br></div>

<div class="col-md-12">
    <p><a href="#" style="text-decoration:underline">Edit</a>&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline">Close</a>
    <hr style="padding:0;margin:0">
    <br>
</div>

<div class="col-md-7" style="padding-left:0;padding-right:0">
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
                    <p id="carrent_created_at{{ $carrent->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
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
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarRentOffers({{ $carrent->car->id }});"><i class="fa fa-money"></i> Offer</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarComments({{ $carrent->car->id }});"><i class="fa fa-comment"></i> Comment</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTails({{ $carrent->car->id }});"><i class="fa fa-eye"></i> Tail</a>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12" id="commentinput" style="text-align:center;padding-top:20px">
        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-10" style="padding-right:1px">
                    <input type="text" class="form-control" id="comment" placeholder="Add comment">
                </div>
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $carrent->car->id }})">post</button></div>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="amountinput">

    </div>

    <div class="col-md-12" id="tailinput">

    </div>

    <div class="col-md-12" id="list">

    </div>

    <div class="col-md-12"><br></div>

</div>

<div class="col-md-5" style="padding-left:0;padding-right:0">
    <div class="panel panel-danger">
        <div class="panel-heading">
            Reserved Offers
        </div>
        <div class="panel-body">

            Reserved offers are deleted automatically after {{ $carrent->rentreserveholddays }} days.
            <br><br>
            
            <ul class="list-group">

                @foreach($carrentreserves as $carrentreserve)

                    <li class="list-group-item">
                        <p>
                            {{ $carrentreserve->carrentoffer->user->name }}, 
                            <strong>K{{ number_format($carrentreserve->carrentoffer->offer, 2) }}</strong>&nbsp;&nbsp;&nbsp;
                            <span style="font-size:9px;color:gray">{{ $carrentreserve->created_at->diffForHumans() }}</span>
                            <span class="pull-right">
                                <button class="btn btn-xs btn-success" onclick="purchaseReserveCarRentOffer({{ $carrentreserve->id }})"><i class="fa fa-money"></i></button> 
                                <button class="btn btn-xs btn-info" onclick="#"><i class="fa fa-envelope"></i></button> 
                                <button class="btn btn-xs btn-warning" onclick="cancelReserveCarRentOffer({{ $carrentreserve->carrentoffer->id }})"><i class="fa fa-trash"></i></button>
                            </span>
                        </p>
                    </li>

                @endforeach

            </ul>

        </div>
    </div>
</div>
        
@endsection


@section('script')

<script src="{{ asset('js/lightslider/lightslider.min.js') }}"></script>
<script src="{{ asset('js/lightbox/lightbox.min.js') }}"></script>

<script>

    /*
    |
    | Execute initial scripts when document is ready
    |
    */
    $(document).ready(function(e) {

        // Set carrent_created_at timestamp
        timeArray.push(['carrent_created_at{{ $carrent->car->id }}', '{{ $carrent->created_at }}']);

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

        // Initially get offers
        getCarRentOffers({{ $carrent->id }});

    });

</script>

@endsection