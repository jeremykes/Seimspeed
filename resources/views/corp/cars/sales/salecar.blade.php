@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('css')
  <link href="{{ asset('css/lightslider/lightslider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('modal')
  <div class="modal fade" id="purchasedCarSale" tabindex="-1" role="dialog" aria-labelledby="purchasedCarSale" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 style="text-align:center">Sell Car to <strong><span class="confirmCarSellToUser"></span></strong>?</h4>
        </div>
        <div class="modal-body" style="text-align:center">
          Are you sure you want to sell this car to <strong><span class="confirmCarSellToUser"></span></strong>?<br><br>
          <a class="btn btn-success" onclick="$('#purchaseDetails').modal()" data-dismiss="modal">Yes, sell</a>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal">No, go back</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="purchaseDetails" tabindex="-1" role="dialog" aria-labelledby="purchaseDetails" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 style="text-align:center">Selling Car to <strong><span class="confirmCarSellToUser"></span></strong></h4>
        </div>
        <div class="modal-body" style="text-align:center">

          <form action="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/carsalepurchase') }}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" id="reserve_id" name="reserve_id">
            <div class="form-group">
              <label class="col-md-3" for="amount" style="padding-top:10px">Amount offered</label>
              <div class="input-group col-md-9">
                <div class="input-group-addon">K</div>
                <input type="text" class="form-control" name="amount" id="amount" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3" for="tax" style="padding-top:10px">TAX</label>
              <div class="input-group col-md-9">
                <div class="input-group-addon">K</div>
                <input type="text" class="form-control" placeholder="TAX" name="tax" id="tax">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3" for="method" style="padding-top:10px">Method</label>
              <div class="input-group col-md-9">
                <select class="form-control" name="method" id="method">
                  <option>Cash</option>
                  <option>Card</option>
                  <option>Check</option>
                  <option>Direct Deposit</option>
                  <option>Purchase Order</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3" for="note" style="padding-top:10px">Note</label>
              <div class="input-group col-md-9">
                <input type="text" class="form-control" placeholder="Note" name="note" id="note">
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-sm">Sell</button>
              <a class="btn btn-default btn-sm" data-dismiss="modal" href="#">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteReserve" tabindex="-1" role="dialog" aria-labelledby="deleteReserve" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 style="text-align:center">Delete reserve for <strong><span class="confirmCarSellToUser"></span></strong>?</h4>
        </div>
        <div class="modal-body" style="text-align:center">
          Are you sure you want to delete this reserve for <strong><span class="confirmCarSellToUser"></span></strong>?<br><br>
          Deleting the reserve will also delete their offer. There is no undo for this action.<br><br>

          <form action="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/carsalereservedelete') }}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="delete_reserve_id" id="delete_reserve_id">
            <button class="btn btn-danger btn-sm">Yes, delete</button>&nbsp;&nbsp;<a class="btn btn-default" data-dismiss="modal" href="#">No, go back</a>
          </form>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@section('corp-cars')

  @if (Session::has('errormessage'))
  <div class="alert alert-danger">
        {{ Session::get('errormessage') }}
  </div>
  @endif

  <div id="purchased">

    @if ($carsale->status == 'purchased')

      <div class="col-md-12" style="text-align:center">
        <h2>This car has been Purchased.</h2>
        <hr>
        <h4>You can still check out wonderful cars on sale by <strong id="corporate_name">{{ $corporate->name }}</strong> <a class="btn btn-success" href="{{ url('/corporate/'.$corporate->id.'/cars') }}">here</a></h4>
        <span style="color:gray;font-size:9px">The SeimSpeed Team</span>
      </div>

    @endif

  </div>

  @if ($carsale->status != 'purchased')

    <div id="sale">
      
      <div id="reservedlist">

        @if ($carsale->status == 'reserved')

          @allowed('corporate.user', $corporate)

            @role('sales|administrator')

              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Reserved List</div>
                  <div class="panel-body">
                    @foreach ($reserves as $reserve)
                        <a id="useroffername{{ $reserve->carsaleoffer->user->id }}" href="{{ url('/user/'.$reserve->carsaleoffer->user->id) }}">
                            <img class="img-responsive pull-left" src="{{ asset($reserve->carsaleoffer->user->propic) }}" style="width:40px;padding:5px"> 
                            {{ $reserve->carsaleoffer->user->name }}
                        </a> 

                        <input type="hidden" id="temp_reserve_id{{ $reserve->carsaleoffer->user->id }}" value="{{ $reserve->id }}">
                        <input type="hidden" id="temp_amount{{ $reserve->carsaleoffer->user->id }}" value="{{ $reserve->carsaleoffer->offer }}">

                        offered 

                        <span style="font-size:16px">
                          K{{ number_format($reserve->carsaleoffer->offer, 2, '.', ',') }}
                        </span>

                        <span class="pull-right" style="color:grey;font-size:10px">
                          <a style="font-size:9px" class="btn btn-primary btn-xs" onclick="sellCarToUser({{ $reserve->carsaleoffer->user->id }})">Sell to this user</a>&nbsp;&nbsp;
                          <a style="font-size:9px" class="btn btn-danger btn-xs" onclick="deleteCarsaleReserve({{ $reserve->carsaleoffer->user->id }})">Delete Reserve</a>&nbsp;&nbsp;
                          reserved at: {{ $reserve->created_at->format('d/m/Y') }}
                        </span>

                        <hr>
                    @endforeach
                  </div>
                </div>
              </div>  

            @endrole

          @endallowed

        @elseif ($carsale->status == 'sale' && $carsale->reserves()->count() > 0)

          @allowed('corporate.user', $corporate)

            @role('sales|administrator')

              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Reserved List</div>
                  <div class="panel-body">
                    @foreach ($reserves as $reserve)
                        <a id="useroffername{{ $reserve->carsaleoffer->user->id }}" href="{{ url('/user/'.$reserve->carsaleoffer->user->id) }}">
                            <img class="img-responsive pull-left" src="{{ asset($reserve->carsaleoffer->user->propic) }}" style="width:40px;padding:5px"> 
                            {{ $reserve->carsaleoffer->user->name }}
                        </a> 

                        <input type="hidden" id="temp_reserve_id{{ $reserve->carsaleoffer->user->id }}" value="{{ $reserve->id }}">
                        <input type="hidden" id="temp_amount{{ $reserve->carsaleoffer->user->id }}" value="{{ $reserve->carsaleoffer->offer }}">

                        offered 

                        <span style="font-size:16px">
                          K{{ number_format($reserve->carsaleoffer->offer, 2, '.', ',') }}
                        </span>

                        <span class="pull-right" style="color:grey;font-size:10px">
                          <a style="font-size:9px" class="btn btn-primary btn-xs" onclick="sellCarToUser({{ $reserve->carsaleoffer->user->id }})">Sell to this user</a>&nbsp;&nbsp;
                          <a style="font-size:9px" class="btn btn-danger btn-xs" onclick="deleteCarsaleReserve({{ $reserve->carsaleoffer->user->id }})">Delete Reserve</a>&nbsp;&nbsp;
                          reserved at: {{ $reserve->created_at->format('d/m/Y') }}
                        </span>

                        <hr>
                    @endforeach
                  </div>
                </div>
              </div>  

            @endrole

          @endallowed

          <div class="col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading">Reserved List</div>
              <div class="panel-body">
                @if ($carsale->reserves()->count() == 1)
                  1 Person has already reserved this car! 2 More spots left!<br><br>
                  Quickly grab the last spots!
                @elseif ($carsale->reserves()->count() == 2)
                  2 people have already reserved this car! 1 More spot left!<br><br>
                  Quickly grab this last spot!
                @endif
              </div>
            </div>
          </div>  

        @endif

      </div>

      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-body">
            <div class="col-md-3" id="car_images">
                <ul id="lightSlider">

                  @foreach ($carsale->car->images as $image)

                    <li data-thumb="{{ asset($image->img_url) }}">
                      <a href="{{ asset($image->img_url) }}" data-lightbox="image"><img class="img-responsive" src="{{ asset($image->img_url) }}" /></a>
                    </li>

                  @endforeach

                </ul>
            </div>

            <div class="col-md-9">

              <div id="corpuseroptions">
                @allowed('corporate.user', $corporate)

                  <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Options <span class="caret"></span>
                        </span>

                        <ul class="dropdown-menu" role="menu">

                          @role('sales|administrator')

                            <li><a href="#"><i class="fa fa-btn fa-edit"></i> Edit</a></li>

                          @endrole

                        </ul>
                    </li>

                  </ul>

                @endallowed


                <p>
                  <strong><span id="car_make">{{ $carsale->car->make }}</span> <span id="car_model">{{ $carsale->car->model }}</span>. <span id="car_bodytype">{{ $carsale->car->bodytype }}.</span></strong>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="label label-danger" style="font-size:16px">
                    sale
                  </span>
                  &nbsp;&nbsp;
                  <span style="font-size:20px" id="car_price">
                    K{{ number_format($carsale->price, 2, '.', ',') }}
                  </span>
                  <span style="font-size:10px;color:grey" id="car_negotiable">
                    @if ($carsale->negotiable == 1)
                      negotiable
                    @else 
                      not negotiable
                    @endif
                  </span>
                </p>
                <p><span id="car_plates">Plates: {{ $carsale->car->plates }}</span>. <span id="car_physicallocation">Location: {{ $carsale->car->physicallocation }}</span></p> 
                <p id="carsale_note">{{ $carsale->car->note }}</p>
                <p id="car_note">{{ $carsale->note }}</p>

                <p id="carsale_cargroupid">
                  @if ($carsale->cargroup_id)
                      In group <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$carsale->cargroup_id) }}"><span class="label label-primary">go to group</span></a> 
                  @endif
                </p>

                <p>
                  <a onclick="getComments()" style="cursor:pointer"><span style="color:gray;font-size:11px"><span id="carsale_comments_count">{{ $carsale->car->comments()->count() }}</span>  <i class="fa fa-comment-o"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a onclick="getOffers('hof','true')" style="cursor:pointer"><span style="color:gray;font-size:11px"><span id="carsale_offers_count">{{ $carsale->offers()->count() }}</span>  <i class="fa fa-money"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a onclick="getTails()" style="cursor:pointer"><span style="color:gray;font-size:11px"><span id="carsale_tails_count">{{ $carsale->car->tails()->count() }}</span>  <i class="fa fa-eye"></i></span></a>
                </p>

              </div>
            </div>
          </div>
        </div>

        <div id="offers">

          @if ($carsale->status == 'sale')

            <div class="col-md-12">
              <div class="col-md-8 col-md-offset-2" style="padding-top:20px;padding-bottom:10px;">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Your offer</label>
                    <div class="input-group">
                      <div class="input-group-addon">K</div>
                      <input type="text" class="form-control" placeholder="Amount" name="offer" id="offer">
                    </div>
                  </div>
                  <a class="btn btn-success btn-xs" onclick="submitoffer()">Offer</a>
                </form>
                <div class="col-md-12">
                  &nbsp;
                  <div class="alert alert-danger" style="display:none" id="offer_error"></div>
                  <div class="alert alert-success" style="display:none" id="offer_success"></div>
                </div>
              </div>
            </div>

          @endif  

          <div id="sort" class="col-md-12" style="padding:5px">
            <span style="cursor:pointer" id="offerssortfilter1" class="offerssortfilter label label-primary" onclick="sortOfferList('hof',1)">Sorted by Highest Offer First <i class="fa fa-arrow-down"></i></span> <span style="cursor:pointer" id="offerssortfilter2" class="offerssortfilter label label-default" onclick="sortOfferList('lof',2)">Sorted by Lowest Offer First <i class="fa fa-arrow-up"></i></span> <span style="cursor:pointer" id="offerssortfilter3" class="offerssortfilter label label-default" onclick="sortOfferList('nof',3)">Sorted by Newest</span> <span style="cursor:pointer" id="offerssortfilter4" class="offerssortfilter label label-default" onclick="sortOfferList('oof',4)">Sorted by Oldest</span> 
          </div>

          <div id="offerslist">

            @foreach ($offers as $offer)

              <div class="list-group-item col-md-12">
                <div class="col-md-2">
                  <img class="img-responsive" src="{{ asset($offer->user->propic) }}"> 
                </div>
                <div class="col-md-10">
                  <p><strong><a href="{{ url('/user/'.$offer->user->id) }}">{{ $offer->user->name }}</a></strong> <span class="pull-right"><span style="color:gray;font-size:11px">{{ $offer->created_at->diffForHumans() }}</span></span></p>
                  <p style="font-size:18px">K{{ number_format($offer->offer, 2, '.', ',') }} 

                    <span class="pull-right" id="offer_is_reserved">
                      
                      @allowed('corporate.user', $corporate)

                        @role('sales|administrator')

                          @if ($offer->reserve)
                          
                            <span class="label label-primary">reserved</span>  
                          
                          @endif

                        @endrole

                      @endallowed

                    </span>

                  </p>
                  <p class="pull-right">

                    @if ($carsale->reserves()->count() < 3)

                      @allowed('corporate.user', $corporate)

                        @role('sales|administrator')
                          
                          <span class="label label-danger" id="offerlisterror{{ $offer->id }}"></span>
                          <a style="font-size:9px" class="btn btn-xs btn-success" onclick="acceptOffer({{ $offer->id }})">accept offer</a> 
                          <a style="font-size:9px" class="btn btn-xs btn-default" onclick="deleteOffer({{ $offer->id }})">delete offer</a> 

                        @endrole

                      @endallowed

                    @endif

                  </p>
                </div>
              </div>

            @endforeach

          </div>

        </div>
        <div id="comments" style="display:none">
          <div id="commentslist" class="list-group" style="padding-top:0;margin-top:0">
            <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
              <div class="col-md-12">
                    <input type="text" class="form-control" aria-label="Your comment" style="margin-bottom:5px">
                    <a class="btn btn-default btn-xs">Comment</a>
              </div>
            </div>


          </div>
        </div>
        <div id="tails" style="display:none">
          <div id="tailslist" class="list-group" style="padding-top:0;margin-top:0">



          </div>
        </div>

      </div>
    </div>

  @endif
        
@endsection

@section('script')
  <script src="{{ asset('js/lightslider/lightslider.min.js') }}"></script>
  <script src="{{ asset('js/lightbox/lightbox.min.js') }}"></script>

  <script type="text/javascript">

  @if ($carsale->status != 'purchased')

  var sortfilter = 'hof';
  var bottomlist = 'offer';

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
          speed: 1000
      });

      ajaxupdatecarsale();

  });

  var url_corporate_cars = "{{ url('/corporate/'.$corporate->id.'/cars') }}";
  var corporate_name = "{{ $corporate->name }}";
  

  function ajaxupdatecarsale() {
      $.ajax({
          url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxupdatecarsale') }}",
          type: "GET",
          success: function(data) {
              if (data['carsale_status'] == 'purchased') {
                  $('#purchased').html('<div class="col-md-12" style="text-align:center"><h2>This car has been Purchased.</h2><hr><h4>You can still check out wonderful cars on sale by <strong id="corporate_name">'+corporate_name+'</strong> <a class="btn btn-success" href="'+url_corporate_cars+'">here</a></h4><span style="color:gray;font-size:9px">The SeimSpeed Team</span></div>');

              } else if (data['carsale_status'] == 'reserved') {
                  if (data['corporate_user'] == true && data['has_role_sales_or_admin'] == true && data['carsale_reserves_count'] > 0) {

                      if (data['carsale_reserves'].length > 0) {

                          htmltext = '';

                          htmltext += '<div class="col-md-12"><div class="panel panel-primary"><div class="panel-heading">Reserved List</div><div class="panel-body">';
                          
                          for (var i = 0; i < data['carsale_reserves'].length; i++) {
                              htmltext += '<a id="useroffername' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" href="' + data['carsale_reserves'][i]['reserve_carsale_offer_user_url'] + '"><img class="img-responsive pull-left" src="' + data['carsale_reserves'][i]['reserve_carsale_offer_user_propic'] + '" style="width:40px;padding:5px"> ' + data['carsale_reserves'][i]['reserve_carsale_offer_user_name'] + '</a><input type="hidden" id="temp_reserve_id' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" value="' + data['carsale_reserves'][i]['reserve_id'] + '"><input type="hidden" id="temp_amount' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" value="' + data['carsale_reserves'][i]['reserve_carsale_offer'] + '"> offered <span style="font-size:16px">K' + data['carsale_reserves'][i]['reserve_carsale_offer'] + '</span><span class="pull-right" style="color:grey;font-size:10px"><a style="font-size:9px" class="btn btn-primary btn-xs" onclick="sellCarToUser(' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + ')">Sell to this user</a>&nbsp;&nbsp;<a style="font-size:9px" class="btn btn-danger btn-xs" onclick="deleteCarsaleReserve(' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + ')">Delete Reserve</a>&nbsp;&nbsp;reserved at: ' + data['carsale_reserves'][i]['reserve_created_at'] + '</span><hr>';
                          }

                          htmltext += '</div></div></div>';

                          $('#reservedlist').html(htmltext);

                      }

                  }
              } else if (data['carsale_status'] == 'sale' && data['carsale_reserves_count'] > 0) {

                  htmltext = '';

                  if (data['corporate_user'] == true && data['has_role_sales_or_admin'] == true && data['carsale_reserves_count'] > 0) {

                      if (data['carsale_reserves'].length > 0) {

                          htmltext = '';

                          htmltext += '<div class="col-md-12"><div class="panel panel-primary"><div class="panel-heading">Reserved List</div><div class="panel-body">';
                          
                          for (var i = 0; i < data['carsale_reserves'].length; i++) {
                              htmltext += '<a id="useroffername' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" href="' + data['carsale_reserves'][i]['reserve_carsale_offer_user_url'] + '"><img class="img-responsive pull-left" src="' + data['carsale_reserves'][i]['reserve_carsale_offer_user_propic'] + '" style="width:40px;padding:5px"> ' + data['carsale_reserves'][i]['reserve_carsale_offer_user_name'] + '</a><input type="hidden" id="temp_reserve_id' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" value="' + data['carsale_reserves'][i]['reserve_id'] + '"><input type="hidden" id="temp_amount' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + '" value="' + data['carsale_reserves'][i]['reserve_carsale_offer'] + '"> offered <span style="font-size:16px">K' + data['carsale_reserves'][i]['reserve_carsale_offer'] + '</span><span class="pull-right" style="color:grey;font-size:10px"><a style="font-size:9px" class="btn btn-primary btn-xs" onclick="sellCarToUser(' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + ')">Sell to this user</a>&nbsp;&nbsp;<a style="font-size:9px" class="btn btn-danger btn-xs" onclick="deleteCarsaleReserve(' + data['carsale_reserves'][i]['reserve_carsale_offer_user_id'] + ')">Delete Reserve</a>&nbsp;&nbsp;reserved at: ' + data['carsale_reserves'][i]['reserve_created_at'] + '</span><hr>';
                          }

                          htmltext += '</div></div></div>';

                          $('#reservedlist').html(htmltext);

                      }

                  }

                  
                  htmltext += '<div class="col-md-12"><div class="panel panel-primary"><div class="panel-heading">Reserved List</div><div class="panel-body">';

                  if (data['carsale_reserves_count'] == 1) {
                      htmltext += '1 Person has already reserved this car! 2 More spots left!<br><br>Quickly grab the last spots!';
                  } else if (data['carsale_reserves_count'] == 2) {
                      htmltext += '2 people have already reserved this car! 1 More spot left!<br><br>Quickly grab this last spot!';
                  }

                  htmltext += '</div></div></div>';
                  $('#reservedlist').html(htmltext);
              }

              $('#carsale_offers_count').html(data['carsale_offer_count']); 
              
              $('#carsale_comments_count').html(data['carsale_comment_count']);  
                   
              $('#carsale_tails_count').html(data['carsale_tail_count']);  

              // check with bottom list is currently open and get the information for that bottom list only and not all bottom lists 
              if (bottomlist == 'offer') {
                  getOffers(sortfilter,'false');  
              } else if (bottomlist == 'comment') {
                  getComments();  
              } else if (bottomlist == 'tail') {
                  getTails();  
              }
                      
              setTimeout(function() {
                  ajaxupdatecarsale();
              }, 10000); 
          }
      });
  }

  function getOffers(sort,forceit) {
    bottomlist = 'offer';
    sortfilter = sort;

    $('#offers').show();
    $('#comments').hide();
    $('#tails').hide();

    $.ajax({
        url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxgetcarsaleoffers') }}",
        type: "GET",
        data: { 
            'sort': sortfilter,
            'forceit': forceit
        },
        success: function(offerdata) {
            htmltext = '';
            for (var i = 0; i < offerdata['offers'].length; i++) {
                htmltext += '<div class="list-group-item col-md-12"><div class="col-md-2"><img class="img-responsive" src="'+offerdata['offers'][i]['offer_user_propic']+'"> </div><div class="col-md-10"><p><strong><a href="'+offerdata['offers'][i]['offer_user_url']+'">'+offerdata['offers'][i]['offer_user_name']+'</a></strong><span class="pull-right"><span style="color:gray;font-size:11px">'+offerdata['offers'][i]['offer_created_at']+'</span></span></p><p style="font-size:18px">K'+offerdata['offers'][i]['offer_offer']+'</p><p class="pull-right">';
                
                if (offerdata['offer_reserves_count'] < 3 && offerdata['corporate_user'] == true && offerdata['has_role_sales_or_admin'] == true) {
                  htmltext += '<span class="label label-danger" id="offerlisterror'+offerdata['offers'][i]['offer_id']+'"></span><a style="font-size:9px" class="btn btn-xs btn-success" onclick="acceptOffer('+offerdata['offers'][i]['offer_id']+')">accept offer</a><a style="font-size:9px" class="btn btn-xs btn-default" onclick="deleteOffer('+offerdata['offers'][i]['offer_id']+')">delete offer</a>';
                }

                htmltext += '</p></div></div>';
            }

            if (htmltext != '') {
                $('#offerslist').html(htmltext);
            }
        }
    });
  }

  function getComments() {
    bottomlist = 'comment';

    $('#comments').show();
    $('#offers').hide();
    $('#tails').hide();

    $.ajax({
        url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxgetcarsalecomments') }}",
        type: "GET",
        data: { 
            
        },
        success: function(commentdata) {
            htmltext = '';
            for (var i = 0; i < commentdata.length; i++) {
                htmltext += '<div class="list-group-item col-md-12"><div class="col-md-1"><img class="img-responsive" src="'+commentdata[i]['comment_user_propic']+'" style="height:40px;width:auto"></div><div class="col-md-11"><p><strong><a href="'+commentdata[i]['comment_user_url']+'">'+commentdata[i]['comment_user_name']+'</a></strong> <span class="pull-right"><span style="color:gray;font-size:11px">'+commentdata[i]['comment_created_at']+'</span></span></p><p>'+commentdata[i]['comment_comment']+'</p></div></div>';
            }

            if (htmltext != '') {
                $('#commentslist').append(htmltext);
            }
        }
    });
  }

  function getTails() {
    bottomlist = 'tail';

    $('#tails').show();
    $('#offers').hide();
    $('#comments').hide();

    $.ajax({
        url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxgetcarsaletails') }}",
        type: "GET",
        data: { 
            
        },
        success: function(taildata) {
            htmltext = '';
            for (var i = 0; i < taildata.length; i++) {
                htmltext += '<div class="list-group-item col-md-12"><div class="col-md-12" style="padding:10px;"><a href="'+taildata[i]['tail_user_url']+'"><img src="'+taildata[i]['tail_user_propic']+'" style="height:50px;width:auto">&nbsp;&nbsp;&nbsp;<strong>'+taildata[i]['tail_user_name']+'</strong></a><span class="pull-right"><span style="color:gray;font-size:11px">'+taildata[i]['tail_created_at']+'</span></span></div></div>';
            }

            if (htmltext != '') {
                $('#tailslist').append(htmltext);
            }
        }
    });
  }

  function sortOfferList(sortby,primaryid) {
    sortfilter = sortby;
    getOffers(sortfilter, 'true');
    sortOfferListSetClasses(primaryid)
  }

  function sortOfferListSetClasses(primaryid) {
    $(".offerssortfilter").removeClass("label-default label-primary").addClass("label-default");
    $("#offerssortfilter"+primaryid).addClass("label-primary");
  }

  function sellCarToUser(userid) {
    $('.confirmCarSellToUser').html($('#useroffername'+userid).text());
    $('#reserve_id').val($('#temp_reserve_id'+userid).val());
    $('#amount').val($('#temp_amount'+userid).val());
    $('#purchasedCarSale').modal();
  }

  function submitoffer() {
    $.ajax({
        url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxcreatecarsaleoffer') }}",
        type: "POST",
        data: { 
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == false) {
              $('#offer_success').hide();
              $('#offer_error').show().html(data['errormessage']);
            } else {
              $('#offer_error').hide();
              $('#offer_success').show().html('You have successfully submitted your offer. You will be notified if your offer is accepted.');
              getOffers('hof',true);
            }
        }
    });
  }

  function deleteCarsaleReserve(userid) {
    $('.confirmCarSellToUser').html($('#useroffername'+userid).text());
    $('#delete_reserve_id').val($('#temp_reserve_id'+userid).val());
    $('#deleteReserve').modal();
  }

  function acceptOffer(offerID) {
    $.ajax({
        url: "{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxacceptcarsaleoffer') }}",
        type: "POST",
        data: { 
            'offer_id': offerID
        },
        success: function(data) {
            if (data['success'] == false) {
              $('#offerlisterror'+offerID).show().html(data['errormessage']);
            } else {
              ajaxupdatecarsale();
              getOffers('hof',true);
              $('#offerlisterror'+offerID).html('').hide();
            }
        }
    });
  }

  function deleteOffer(offerID) {
    // delete offer
  }

  @endif

  </script>
@endsection
