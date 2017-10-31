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

    var publicCarTradeChannel = pusher.subscribe('public-channel.car.{{ $carauction->car->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarAuctionClosed', function(data) {
        CarAuctionClosedBuildTrade(data.carauction[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReservePurchased', function(data) {
        CarAuctionBidReservePurchasedBuildTrade(data.carauction[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserved', function(data) {
        CarAuctionBidReservedBuildTrade(data.carauctionbid[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserveCancelled', function(data) {
        CarAuctionBidReserveCancelledBuildTrade(data.carauctionbid[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data.carcomment[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidAdded', function(data) {
        CarAuctionBidAddedBuildTrade(data.carauctionbid[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidCancelled', function(data) {
        CarAuctionBidCancelledBuildTrade(data.carauctionbid[0]);
    }); 

</script>

@ensection


@section('content')

<!-- Build initially with PHP -->

<!-- Later you update each element with JS -->

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">

            <div class="col-md-12">
                <a href="{{ url('/corporate/' . $carauction->corporate->id) }}"><span style="font-size:20px;font-weight:bold">{{ $carauction->corporate->name }}</span></a>
                
                @if (Auth::check())
                    @if (Auth::user()->corporateuser->corporate->id == $carauction->corporate->id && ( Auth::user()->hasRole('sales') || Auth::user()->hasRole('administrator') ) )
                        <a class="btn btn-default btn-xs pull-right" href="{{ url('/corporate/' . $carauction->corporate->id . '/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id ) }}">See in Store</a>
                    @endif
                @endif

                <hr style="padding:5px;margin:0">
            </div>

            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                @foreach ($carauction->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->img_url }}"/></a>
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
                <p id="carauction_created_at{{ $carauction->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                <p class="pull-right" id="carauctionsignup">
                    @if ($carauction->signuprequired == 0) 
                        <span class="label label-warning">Signup required</span> <span style="font-size:16px">{{ $carauction->signupfee }}</span>
                    @else
                        <span class="label label-warning">Signup not required</span>
                    @endif
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

<div class="col-md-12" id="commentinput" style="text-align:center;padding-top:20px">
    @if (Auth::check())
        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-10" style="padding-right:1px">
                    <input type="text" class="form-control" id="comment" placeholder="Add comment">
                </div>
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $carauction->car->id }})">post</button></div>
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
                <label>Your bid</label>
                <div class="input-group">
                  <div class="input-group-addon">K</div>
                  <input type="text" class="form-control" placeholder="Amount" name="bid" id="bid">
                </div>
              </div>
              <a class="btn btn-success btn-xs" onclick="submitCarAuctionBid({{ $carauction->car->id }})">Bid</a>
            </div>
          </div>
        </div>
    @else
        <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
            You have to be logged in to post a bid.
        </div>
    @endif
</div>

<div class="col-md-12" id="tailinput" style="text-align:center;padding-top:30px;padding-bottom:30px">
    @if (Auth::check())
        <button class="btn btn-primary" onclick="tailCar({{ $carauction->car->id }})" id="cartailbutton"></button>
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

        // Set carauction_created_at timestamp
        timeArray.push(['carauction_created_at{{ $carauction->car->id }}', '{{ $carauction->created_at }}']);

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

        // Initially get bids
        getCarAuctionBids({{ $carauction->id }});

    });


</script>

@endsection