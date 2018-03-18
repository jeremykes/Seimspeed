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
        CarTenderTenderCancelledBuildTrade(data.cartendertender[0]);
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
                <a href="{{ url('/corporate/' . $cartender->corporate->id) }}"><span style="font-size:20px;font-weight:bold">{{ $cartender->corporate->name }}</span></a>
                
                @if (Auth::check() && !(is_null(Auth::user()->corporateuser)))
                    @if (Auth::user()->corporateuser->corporate->id == $cartender->corporate->id && ( Auth::user()->hasRole('sales') || Auth::user()->hasRole('administrator') ) )
                        <a class="btn btn-default btn-xs pull-right" href="{{ url('/corporate/' . $cartender->corporate->id . '/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id ) }}">See in Store</a>
                    @endif
                @endif

                <hr style="padding:5px;margin:0">
            </div>
            
            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                @foreach ($cartender->car->images as $carimage)

                    <li id="carimage{{ $carimage->id }}" data-thumb="{{ $carimage->img_url }}">
                      <a href="{{ $carimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $carimage->img_url }}"/></a>
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
                    </span>
                </p>
                <p id="cartender_created_at{{ $cartender->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                <p id="cartendersignup">
                    @if ($cartender->signuprequired == 1) 
                        <span class="label label-warning">Signup required</span> <span style="font-size:13px">K{{ number_format($cartender->signupfee, 2) }} signup fee.</span>
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
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTenderTenders({{ $cartender->id }});"><i class="fa fa-money"></i> Tender</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarComments({{ $cartender->car->id }});"><i class="fa fa-comment"></i> Comment</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTails({{ $cartender->car->id }});"><i class="fa fa-eye"></i> Tail</a>
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
        @if ($cartender->signuprequired == 0)
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
            @if ($user_can_tender == true) 
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
                      <a class="btn btn-success btn-xs" onclick="submitCarTenderTender({{ $cartender->id }})">Tender</a>
                    </div>
                  </div>
                </div>
            @else
                @if ($user_not_req == true) 
                    <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
                        You have to request signup to start placing tenders. <br><br><span class="btn btn-primary btn-md" onclick="confirmMe('Are you sure you want to sign up for this tender?<br>The owners will contact you shortly.', 'carTenderSignUp({{ $cartender->id }})', 'primary')">Request Sign Up</span>
                    </div>
                @else 
                    <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
                        Your request is still pending. Please check again later.
                    </div>
                @endif
            @endif
        @endif
    @else
        <div class="col-sm-12" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
            You have to be logged in to post a tender.
        </div>
    @endif
</div>

<div class="col-md-12" id="tailinput" style="text-align:center;padding-top:20px;padding-bottom:20px;color:grey;">
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