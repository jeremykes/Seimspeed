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

                @foreach ($partsale->part->images as $partimage)

                    <li id="partimage{{ $partimage->id }}" data-thumb="{{ $partimage->thumb_img_url }}">
                      <a href="{{ $partimage->img_url }}" data-lightbox="image"><img class="img-responsive" src="{{ $partimage->thumb_img_url }}"/></a>
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
                <p id="partdetails">
                    Serial: <span style="font-weight:bold">{{ $partsale->part->bodytype }}</span>. 
                    Location: <span style="font-weight:bold">{{ $partsale->part->physicallocation }}</span>. 
                    <br>
                    <span id="partdesc">{{ $partsale->part->descript }}</span>
                    <br>
                    <span style="font-size:11px;color:grey">{{ $partsale->part->note }}
                </p>
                <p id="partsalenegotiable">
                    @if ($partsale->negotiable == 0) 
                        <span class="label label-warning">Negotiable</span>
                    @else
                        <span class="label label-warning">Not negotiable</span>
                    @endif
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