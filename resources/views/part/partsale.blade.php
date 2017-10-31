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

            <div class="col-md-12">
                <a href="{{ url('/corporate/' . $partsale->corporate->id) }}"><span style="font-size:20px;font-weight:bold">{{ $partsale->corporate->name }}</span></a>
                <hr style="padding:5px;margin:0">
            </div>
            
            <div class="col-md-3" id="part_images">
                <ul id="lightSlider">

                @foreach ($partsale->part->images as $partimage)

                    <li id="partimage{{ $partimage->id }}" data-thumb="{{ $partimage->img_url }}">
                      <a href="{{ $partimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $partimage->img_url }}"/></a>
                    </li>

                @endforeach

                </ul>
            </div>
            <div class="col-md-9">

                <p>
                    <span style="text-decoration:bold;font-size:14px;color:gray">
                        <span id="partname">{{ $partsale->part->name }}</span> 
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <label class="label label-danger" style="font-size:16px">sale</label>
                    <span class="pull-right">
                        <span style="font-size:20px" id="partprice">K{{ number_format($partsale->price, 2) }}</span>
                    </span>
                </p>
                <p id="partsale_created_at{{ $partsale->part->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                <p class="pull-right" id="partsalenegotiable">
                    @if ($partsale->negotiable == 0) 
                        <span class="label label-warning">Negotiable</span>
                    @else
                        <span class="label label-warning">Not negotiable</span>
                    @endif
                </p>
                <p id="partdetails">
                    Serial: <span style="font-weight:bold">{{ $partsale->part->bodytype }}</span>. 
                    Location: <span style="font-weight:bold">{{ $partsale->part->physicallocation }}</span>. 
                    <br>
                    <span id="partdesc">{{ $partsale->part->descript }}</span>
                    <br>
                    <span style="font-size:11px;color:grey">{{ $partsale->part->note }}
                </p>
                <p id="partsalenote"><hr style="margin:2px"><span style="font-size:11px;color:grey">{{ $partsale->note }}</span></p>
                
                @if ($partsale->group)
                    <p>In group <a href="#"><span class="label label-primary">go to group</span></a></p>
                @endif

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
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewPartComment({{ $partsale->part->id }})">post</button></div>
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
              <a class="btn btn-success btn-xs" onclick="submitPartSaleOffer({{ $partsale->part->id }})">Offer</a>
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
        <button class="btn btn-primary" onclick="tailPart({{ $partsale->part->id }})" id="parttailbutton"></button>
    @else
        You have to be logged in to tail this part.
    @endif
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
                getMessages();
            } else { 
                // Notification appending happens here.
                getNotifications();
            }
        }

    @endif

    var publicPartTradeChannel = pusher.subscribe('public-channel.partsale.{{ $partsale->id }}');

    publicPartTradeChannel.bind('App\\Events\\PartSaleClosed', function(data) {
    	PartSaleClosedBuildTrade(data); 
    });
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReservePurchased', function(data) {
    	PartSaleOfferReservePurchasedBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReserved', function(data) {
    	PartSaleOfferReservedBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReserveCancelled', function(data) {
    	PartSaleOfferReserveCancelledBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartCommentAdded', function(data) {
    	PartCommentAddedBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferAdded', function(data) {
    	PartSaleOfferAddedBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferCancelled', function(data) {
    	PartSaleOfferCancelledBuildTrade(data);
    }); 

</script>

@endsection