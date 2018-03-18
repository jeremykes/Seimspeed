@extends('layouts.trade')

@section('css')
  <link href="{{ asset('css/lightslider/lightslider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection


@section('realtime')

<script>

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
        CarRentOfferReservedBuildTrade(data.carrentoffer[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferReserveCancelled', function(data) {
        CarRentOfferReserveCancelledBuildTrade(data.carrentoffer[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data.carcomment[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferAdded', function(data) {
        CarRentOfferAddedBuildTrade(data.carrentoffer[0]);
    });
    publicCarTradeChannel.bind('App\\Events\\CarRentOfferCancelled', function(data) {
        CarRentOfferCancelledBuildTrade(data.carrentoffer[0]);
    });

</script>

@endsection

@section('content')

<!-- Build initially with PHP -->

<!-- Later you update each element with JS -->

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">

            <div class="col-md-12">
                <a href="{{ url('/corporate/' . $carrent->corporate->id) }}"><span style="font-size:20px;font-weight:bold">{{ $carrent->corporate->name }}</span></a>
                    
                @if (Auth::check() && !(is_null(Auth::user()->corporateuser)))
                    @if (Auth::user()->corporateuser->corporate->id == $carrent->corporate->id && ( Auth::user()->hasRole('sales') || Auth::user()->hasRole('administrator') ) )
                        <a class="btn btn-default btn-xs pull-right" href="{{ url('/corporate/' . $carrent->corporate->id . '/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id ) }}">See in Store</a>
                    @endif
                @endif

                <hr style="padding:5px;margin:0">
            </div>            

            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                @foreach ($carrent->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->img_url }}"/></a>
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
                <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Offer</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12" id="commentinput" style="text-align:center;padding-top:20px">
    @if (Auth::check())
        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-10" style="padding-right:1px">
                    <input type="text" class="form-control" id="comment" placeholder="Add comment">
                </div>
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $carrent->car->id }})">post</button></div>
            </div>
        </div>
    @else
        <div class="col-sm-12" style="text-align:center;padding-bottom:20px;color:grey;">
            You have to be logged in to post comments.
        </div>
    @endif
</div>

<div class="col-md-12" id="amountinput">
    @if (Auth::check())
        <div class="col-md-12">
          <div class="col-md-8 col-md-offset-2" style="padding-top:20px;padding-bottom:10px;">
            <div class="form-inline">
              <div class="form-group">
                <label>Your offer</label>
                <div class="input-group">
                  <div class="input-group-addon">K</div>
                  <input type="text" class="form-control" placeholder="Amount" name="offer" id="offer">
                </div>
              </div>
              <a class="btn btn-success btn-xs" onclick="submitCarRentOffer({{ $carrent->car->id }})">Offer</a>
            </div>
          </div>
        </div>
    @else
        <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
            You have to be logged in to post an offer.
        </div>
    @endif
</div>

<div class="col-md-12" id="tailinput" style="text-align:center;padding-top:30px;padding-bottom:30px">
    @if (Auth::check())
        <button class="btn btn-primary" onclick="tailCar({{ $carrent->car->id }})" id="cartailbutton"></button>
    @else
        You have to be logged in to tail this car.
    @endif
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