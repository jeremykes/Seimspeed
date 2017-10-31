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

    var publicPartTradeChannel = pusher.subscribe('public-channel.partsale.{{ $partsale->id }}');

    publicPartTradeChannel.bind('App\\Events\\PartSaleClosed', function(data) {
        PartSaleClosedBuildTrade(data.partsale[0]); 
    });
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReservePurchased', function(data) {
        PartSaleOfferReservePurchasedBuildTrade(data.partsale[0]);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReserved', function(data) {
        PartSaleOfferReservedBuildTrade(data.partsalereserve);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferReserveCancelled', function(data) {
        PartSaleOfferReserveCancelledBuildTrade(data);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartCommentAdded', function(data) {
        PartCommentAddedBuildTrade(data.partsale[0]);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferAdded', function(data) {
        PartSaleOfferAddedBuildTrade(data.partsale[0]);
    }); 
    publicPartTradeChannel.bind('App\\Events\\PartSaleOfferCancelled', function(data) {
        PartSaleOfferCancelledBuildTrade(data.partsaleoffer);
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

<!-- Purchased Form -->
<div class="modal fade" tabindex="-1" role="dialog" id="salePurchaseModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">                        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Purchase Details</h4>
            </div>
            <div class="modal-body">

                @include('common.errors')

                <form action="{{ url('/corporate/' . $corporate->id .'/corpuser/sales/part/purchasesale') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" id="partsalereserve_id" name="partsalereserve_id">    

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="additionalfees" class="col-sm-2 control-label">Additional fees</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="additionalfees" name="additionalfees">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="additionalfeesdescript" class="col-sm-2 control-label">Additional fees description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="additionalfeesdescript" name="additionalfeesdescript" placeholder="Additional fees description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="method" class="col-sm-2 control-label">Payment method</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="method" name="method">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="onlinetransfer">Online transfer</option>
                                    <option value="bankdeposit">Bank deposit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="note" placeholder="Note">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Purchase</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
    </div>
</div>

<div class="col-md-12"><br></div>

<div class="col-md-12">
    <p><a href="#" style="text-decoration:underline">Edit</a>&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline">Close</a>
    <hr style="padding:0;margin:0">
    <br>
</div>

<div class="col-md-7" style="padding-left:0;padding-right:0">
    <div class="col-md-12">

        @include('common.errors')
    
        <div class="panel" style="padding-bottom:0;margin-bottom:0">
            <div class="panel-body">
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
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getPartSaleOffers({{ $partsale->part->id }});"><i class="fa fa-money"></i> Offer</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getPartComments({{ $partsale->part->id }});"><i class="fa fa-comment"></i> Comment</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getPartTails({{ $partsale->part->id }});"><i class="fa fa-eye"></i> Tail</a>
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
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewPartComment({{ $partsale->part->id }})">post</button></div>
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

            Reserved offers are deleted automatically after {{ $partsale->salereserveholddays }} days.
            <br><br>
            
            <ul class="list-group">

                @foreach($partsalereserves as $partsalereserve)

                    <li class="list-group-item">
                        <p>
                            {{ $partsalereserve->partsaleoffer->user->name }}, 
                            <strong>K{{ number_format($partsalereserve->partsaleoffer->offer, 2) }}</strong>&nbsp;&nbsp;&nbsp;
                            <span style="font-size:9px;color:gray">{{ $partsalereserve->created_at->diffForHumans() }}</span>
                            <span class="pull-right">
                                <button class="btn btn-xs btn-success" onclick="purchaseReservePartSaleOfferForm({{ $partsalereserve->id }})"><i class="fa fa-money"></i></button> 
                                <button class="btn btn-xs btn-info" onclick="#"><i class="fa fa-envelope"></i></button> 
                                <button class="btn btn-xs btn-warning" onclick="cancelReservePartSaleOffer({{ $partsalereserve->partsaleoffer->id }})"><i class="fa fa-trash"></i></button>
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

    $(document).ready(function(e) {

        // Set partsale_created_at timestamp
        timeArray.push(['partsale_created_at{{ $partsale->part->id }}', '{{ $partsale->created_at }}']);

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
        getPartSaleOffers({{ $partsale->id }});

    });


</script>

@endsection