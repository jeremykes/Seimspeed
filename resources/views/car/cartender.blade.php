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

    @if (Auth::check())
        var privateUserChannel = pusher.subscribe('private-App.User.' + {{ Auth::user()->id }});

        privateUserChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
            BroadcastNotificationCreated(data);
        });

        function BroadcastNotificationCreated(data) {
            if (data.type == 'App\\Notifications\\NewMessageNotification') {
                // New Message Notification appending happens here.
                getMessages();
            } else { 
                // Notification appending happens here.
                getNotifications();
            }
        }

    @endif

    var publicCarTradeChannel = pusher.subscribe('public-channel.car.{{ $cartender->car->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarTenderClosed', function(data) {
        CarTenderClosedBuildTrade(data.cartender[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarTenderTenderReservePurchased', function(data) {
        CarTenderTenderReservePurchasedBuildTrade(data.cartender[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarTenderTenderReserved', function(data) {
        CarTenderTenderReservedBuildTrade(data.cartendertender[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarTenderTenderReserveCancelled', function(data) {
        CarTenderTenderReserveCancelledBuildTrade(data.cartendertender[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarCommentAdded', function(data) {
        CarCommentAddedBuildTrade(data.carcomment[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarTenderTenderAdded', function(data) {
        CarTenderTenderAddedBuildTrade(data.cartendertender[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarTenderTenderCancelled', function(data) {
        CarTenderTenderCancelledBuildTrade(data.cartendertender[0])) 
    }); 
</script>

@endsection


@section('content')

<!-- Build initially with PHP -->

<!-- Later you update each element with JS -->

<div class="col-md-12">
    <div class="panel" style="padding-bottom:0;margin-bottom:0">
        <div class="panel-body">
            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                @foreach ($cartender->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->thumb_img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->thumb_img_url }}"/></a>
                    </li>

                @endforeach

                </ul>
            </div>
            <div class="col-md-9">

                <p>
                    <span style="text-decoration:bold;font-size:14px;color:gray">
                        <span id="carmake">{{ $cartender->car->make }}</span> 
                        <span id="carmodel">{{ $cartender->car->model }}</span>, 
                        <span id="carcolor">{{ $cartender->car->color }}</span>, 
                        <span id="cardrive"></span>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label label-danger" style="font-size:16px">tender</label>
                    <span class="pull-right">
                        <span style="font-size:20px" id="carprice">K{{ number_format($cartender->price, 2) }}</span>
                    </span>
                </p>
                <p id="cartender_created_at{{ $cartender->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                <p class="pull-right" id="cartendersignup">
                    @if ($cartender->signuprequired == 0) 
                        <span class="label label-warning">Signup required</span> <span style="font-size:16px">{{ $cartender->signupfee }}</span>
                    @else
                        <span class="label label-warning">Signup not required</span>
                    @endif
                </p>
                <p id="cardetails">
                    Body type: <span style="font-weight:bold">{{ $cartender->car->bodytype }}</span>. 
                    Weight: <span style="font-weight:bold">{{ $cartender->car->weight }}</span>Kg's. 
                    Fuel Type: <span style="font-weight:bold">{{ $cartender->car->fueltype }}</span>. 
                    Transmission: <span style="font-weight:bold">{{ $cartender->car->transmissiontype }}</span>. 
                    Steering side: <span style="font-weight:bold">{{ $cartender->car->steeringside }}</span>. 
                    Location: <span style="font-weight:bold">{{ $cartender->car->physicallocation }}</span>. 
                    <br>
                    Start: <span style="font-weight:bold">{{ $cartender->startdate->diffForHumans() }}</span>. 
                    End: <span style="font-weight:bold">{{ $cartender->enddate->diffForHumans() }}</span>. 
                    <br>
                    <span style="font-size:11px;color:grey">{{ $cartender->car->note }}
                </p>
                <p id="cartendernote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $cartender->note }}</span></p>
                
                @if ($cartender->group)
                    <p>In group <a href="#"><span class="label label-primary">go to group</span></a></p>
                @endif

            </div>

            <div class="col-md-12">
                <hr style="margin:10px">
                <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Tender</a>
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
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $cartender->car->id }})">post</button></div>
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
                <label>Your tender</label>
                <div class="input-group">
                  <div class="input-group-addon">K</div>
                  <input type="text" class="form-control" placeholder="Amount" name="tender" id="tender">
                </div>
              </div>
              <a class="btn btn-success btn-xs" onclick="submitCarTenderTender({{ $cartender->car->id }})">Tender</a>
            </div>
          </div>
        </div>
    @else
        <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
            You have to be logged in to post a tender.
        </div>
    @endif
</div>

<div class="col-md-12" id="tailinput" style="text-align:center;padding-top:30px;padding-bottom:30px">
    @if (Auth::check())
        <button class="btn btn-primary" onclick="tailCar({{ $cartender->car->id }})" id="cartailbutton"></button>
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

        // Set cartender_created_at timestamp
        timeArray.push(['cartender_created_at{{ $cartender->car->id }}', '{{ $cartender->created_at }}']);

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
        getCarTenderTenders({{ $cartender->id }});

    });

</script>

@endsection