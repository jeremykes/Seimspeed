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

    var publicCarTradeChannel = pusher.subscribe('public-channel.car.{{ $carauction->car->id }}');

    publicCarTradeChannel.bind('App\\Events\\CarAuctionClosed', function(data) {
        CarAuctionClosedBuildTrade(data.carauction[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReservePurchased', function(data) {
        CarAuctionBidReservePurchasedBuildTrade(data.carauction[0]);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserved', function(data) {
        CarAuctionBidReservedBuildTrade(data.carauctionreserve);
    }); 
    publicCarTradeChannel.bind('App\\Events\\CarAuctionBidReserveCancelled', function(data) {
        CarAuctionBidReserveCancelledBuildTrade(data);
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
<div class="modal fade" tabindex="-1" role="dialog" id="auctionPurchaseModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">                        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Purchase Details</h4>
            </div>
            <div class="modal-body">

                @include('common.errors')

                <form action="{{ url('/corporate/' . $corporate->id .'/corpuser/auctions/car/purchaseauction') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" id="carauctionreserve_id" name="carauctionreserve_id">    

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

<div class="col-md-12" style="padding-bottom:10px">
    <div class="col-md-12">
        <a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/car/updateauctionform/' . $carauction->id) }}" style="text-decoration:underline">Edit</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="confirmMe('Are you sure you want to close this car auction?', 'closeCarAuction({{ $carauction->id }})', 'danger')">close</a>
        <span class="pull-right" style="font-size:13px;color:rgb(255,75,87);">Auction ends {{ $carauction->enddate->diffForHumans() }} ({{ $carauction->enddate->format('d-m-Y') }})</span>
    </div>

    <div class="col-md-12">
        <hr style="padding:0;margin:0">
    </div>
    
</div>

<div class="col-md-7" style="padding-left:0;padding-right:0">
    <div class="col-md-12">

        @include('common.errors')

        <div class="panel" style="padding-bottom:0;margin-bottom:0">
            <div class="panel-body">
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
                        </span>
                    </p>
                    <p id="carauction_created_at{{ $carauction->car->id }}" style="color:rgb(255,75,87);font-size:11px"></p>
                    <p class="pull-right" id="carauctionsignup">
                        @if ($carauction->signuprequired == 1) 
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
                        <span class="label label-info">Start bid price</span>: <span style="font-weight:bold;font-size:16px">K{{ number_format($carauction->startbidprice) }}</span>. 
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
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarAuctionBids({{ $carauction->car->id }});"><i class="fa fa-money"></i> Bid</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarComments({{ $carauction->car->id }});"><i class="fa fa-comment"></i> Comment</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" style="cursor:pointer" onclick="getCarTails({{ $carauction->car->id }});"><i class="fa fa-eye"></i> Tail</a>
                </div>

            </div>

            <div class="col-md-12" style='padding-top:10px;padding-bottom:10px'>
                Export bidders list as;    
                <a href="{{ url('/corporate/'.$corporate->id.'/corpuser/sales/car/carauction/'.$carauction->id.'/auctions/export?format=csv') }}">CSV</a>, 
                <a href="{{ url('/corporate/'.$corporate->id.'/corpuser/sales/car/carauction/'.$carauction->id.'/auctions/export?format=xlsx') }}">XLSX</a>, or  
                <a href="{{ url('/corporate/'.$corporate->id.'/corpuser/sales/car/carauction/'.$carauction->id.'/auctions/export?format=html') }}">HTML</a>
            </div>

        </div>
    </div>

    <div class="col-md-12" id="commentinput" style="text-align:center;padding-top:20px">
        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-10" style="padding-right:1px">
                    <input type="text" class="form-control" id="comment" placeholder="Add comment">
                </div>
                <div class="col-sm-2" style="padding-top:6px;padding-left:1px"><button class="btn btn-primary btn-xs" onclick="postNewCarComment({{ $carauction->car->id }})">post</button></div>
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
            Auction Requests
        </div>
        <div class="panel-body">

            @if ($carauction->signuprequired == 1)

                @if ($carauction->signupfee > 0)
                    Please confirm externally that the user has paid the signup fee of <span style="font-size:16px">K{{ number_format($carauction->signupfee) }}</span> before accepting their request here.
                @else 
                    No fee required. Select "accept" to allow the user to start bidding
                @endif

                <br><br>
                
                <ul class="list-group" id="carauctionrequestlist">

                    @foreach($carauctionbidders_pending as $carauctionbidder_pending)

                        <li class="list-group-item">
                            <p>
                                <strong>{{ $carauctionbidder_pending->user->name }} </strong>
                                Requested - {{ $carauctionbidder_pending->created_at->diffForHumans() }}&nbsp;&nbsp;&nbsp;
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-success" onclick="confirmMe('Are you sure you want to accept this user request?', 'carAuctionSignUpAccept({{ $carauctionbidder_pending->id }})', 'success')"><i class="fa fa-check"></i></button> 
                                    <button class="btn btn-xs btn-danger" onclick="confirmMe('Are you sure you want to delete this user request?', 'carAuctionSignUpDecline({{ $carauctionbidder_pending->id }})', 'danger')"><i class="fa fa-trash"></i></button>
                                </span>
                            </p>
                        </li>

                    @endforeach

                </ul>

            @else

                <!-- Sign up NOT required -->

                Tender is free for anyone to submit tenders.

            @endif

        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            Accepted Users
        </div>
        <div class="panel-body">

            @if ($carauction->signuprequired == 1)

                <br>
                
                <ul class="list-group">

                    @foreach($carauctionbidders_accepted as $carauctionbidder_accepted)

                        <li class="list-group-item">
                            <p>
                                <strong>{{ $carauctionbidder_accepted->user->name }} </strong>
                                Accepted - {{ $carauctionbidder_accepted->updated_at->diffForHumans() }}&nbsp;&nbsp;&nbsp;
                                <span class="pull-right">
                                    <button class="btn btn-xs btn-danger" onclick="confirmMe('Are you sure you want to delete this accepted user?<br>There is NO UNDO for this action and all bids submitted by this user will also be deleted!', 'carAuctionBidderDelete({{ $carauctionbidder_accepted->id }})', 'danger')"><i class="fa fa-trash"></i></button>
                                </span>
                            </p>
                        </li>

                    @endforeach

                </ul>

            @else

                <!-- Sign up NOT required -->

                Auction is free for anyone to submit bids.

            @endif

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