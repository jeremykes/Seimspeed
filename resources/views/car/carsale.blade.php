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

    var publicCarTradeChannel = pusher.subscribe('public-channel.car.{{ $carsale->car->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarSaleClosed', function(data) {
        CarSaleClosedBuildTrade(data.carsale[0]); 
    });
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReservePurchased', function(data) {
        CarSaleOfferReservePurchasedBuildTrade(data.carsale[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReserved', function(data) {
        CarSaleOfferReservedBuildTrade(data.carsaleoffer[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferReserveCancelled', function(data) {
        CarSaleOfferReserveCancelledBuildTrade(data.carsaleoffer[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data.carcomment[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferAdded', function(data) {
        CarSaleOfferAddedBuildTrade(data.carsaleoffer[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarSaleOfferCancelled', function(data) {
        CarSaleOfferCancelledBuildTrade(data.carsaleoffer);
    }); 

</script>

@endsection


@section('content')

<div class="col-md-12">
    
</div>

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">

            <div class="col-md-12">
                <a href="{{ url('/corporate/' . $carsale->corporate->id) }}"><span style="font-size:20px;font-weight:bold">{{ $carsale->corporate->name }}</span></a>

                @if (Auth::check() && !(is_null(Auth::user()->corporateuser)))
                    @if (Auth::user()->corporateuser->corporate->id == $carsale->corporate->id && ( Auth::user()->hasRole('sales') || Auth::user()->hasRole('administrator') ) )
                        <a class="btn btn-default btn-xs pull-right" href="{{ url('/corporate/' . $carsale->corporate->id . '/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id ) }}">See in Store</a>
                    @endif
                @endif

                <hr style="padding:5px;margin:0">
            </div>
            
            <div class="col-md-4" id="car_images">
                <ul id="lightSlider">

                @foreach ($carsale->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->img_url }}">
                        <a href="{{ $carimage->img_url }}" data-lightbox="image">
                            <img class="img-responsive" src="{{ $carimage->img_url }}"/>
                        </a>
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
                <p class="pull-right" id="carsalenegotiable" style="font-size:11px">
                    @if ($carsale->negotiable == 0) 
                        <span class="label label-warning">Negotiable</span>
                    @else
                        <span class="label label-warning">Not negotiable</span>
                    @endif
                </p>
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
                <p id="carsalenote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $carsale->note }}</span></p>

            </div>

            <div class="col-md-12">
                <hr style="margin:10px">
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarSaleOffers({{ $carsale->id }});"><i class="fa fa-money"></i> Offer</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarComments({{ $carsale->car->id }});"><i class="fa fa-comment"></i> Comment</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTails({{ $carsale->car->id }});"><i class="fa fa-eye"></i> Tail</a>
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
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $carsale->car->id }})">post</button></div>
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
              <a class="btn btn-success btn-xs" onclick="submitCarSaleOffer({{ $carsale->id }})">Offer</a>
            </div>
          </div>
        </div>
    @else
        <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
            You have to be logged in to post an offer.
        </div>
    @endif
</div>

<div class="col-md-12" id="tailinput" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
    @if (Auth::check())
        <button class="btn btn-primary" onclick="tailCar({{ $carsale->car->id }})" id="cartailbutton"></button>
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

        // Initially get offers
        getCarSaleOffers({{ $carsale->id }});

    });

</script>

@endsection