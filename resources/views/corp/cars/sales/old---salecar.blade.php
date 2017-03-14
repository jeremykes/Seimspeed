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
                  <h4 style="text-align:center">Car has been Purchased</h4>
              </div>
              <div class="modal-body" style="text-align:center">
                      Please select from the <br><br>
                      
                      <a class="btn btn-success" onclick="$('#myform').submit();">Yes, save</a>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal">No, go back</button>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('corp-cars')

  @if ($carsale->status == 'purchased')

    <div class="col-md-12" style="text-align:center">
      <h2>This car has been Purchased.</h2>
      <hr>
      <h4>You can still check out wonderful cars on sale by <strong>{{ $corporate->name }}</strong> <a class="btn btn-success" href="{{ url('/corporate/'.$corporate->id.'/cars') }}">here</a></h4>
      <span style="color:gray;font-size:9px">The SeimSpeed Team</span>
    </div>
    
  @elseif ($carsale->status == 'reserved')
    
    @allowed('corporate.user', $corporate)

      @role('sales|administrator')

        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Reserved List</div>
            <div class="panel-body">
              @foreach ($carsale->reserves() as $reserve)
                  {{ $reserve->carsaleoffer->user->name }} offered K{{ number_format($reserve->carsaleoffer->offer, 2, '.', ',') }}<hr>
              @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <div class="panel-body">
              <div class="col-md-3">
                  <ul id="lightSlider">

                      @foreach ($carsale->car->images as $image)

                        <li data-thumb="{{ asset($image->img_url) }}">
                            <a href="{{ asset($image->img_url) }}" data-lightbox="image"><img class="img-responsive" src="{{ asset($image->img_url) }}" /></a>
                        </li>

                      @endforeach

                  </ul>
              </div>
              <div class="col-md-9">

                  <ul class="nav navbar-nav navbar-right">

                      <li class="dropdown">
                          <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              Options <span class="caret"></span>
                          </span>

                          <ul class="dropdown-menu" role="menu">
                              <li><a data-toggle="modal" data-target="#purchasedCarSale"><i class="fa fa-btn fa-money"></i> Purchased</a></li>
                          </ul>
                      </li>
                  </ul>
                <p>
                  <strong>{{ $carsale->car->make }} {{ $carsale->car->model }}</strong>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="label label-danger" style="font-size:16px">
                    sale
                  </span>
                  &nbsp;&nbsp;
                  <span style="font-size:20px">
                    K{{ number_format($carsale->price, 2, '.', ',') }}
                  </span>
                  <span style="font-size:10px;color:grey">
                    @if ($carsale->negotiable == 1)
                      negotiable
                    @else 
                      not negotiable
                    @endif
                  </span>
                </p>
                <p>{{ $carsale->car->note }}</p>
                <p>{{ $carsale->note }}</p>

                @if ($carsale->cargroup_id)
                  <p>
                    In group <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$carsale->cargroup_id) }}"><span class="label label-primary">go to group</span></a> 
                  </p>
                @endif

                <p>
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $carsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                </p>
              </div> 
            </div>
          </div>
        </div>

      @endrole

    @endallowed

  @elseif ($carsale->status == 'sale' || $carsale->reserves()->count() < 3 )

    <div class="col-md-12">
        <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Back</a>&nbsp;&nbsp;
        <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
        <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
        <span style="color:grey;font-size:10px">></span>
        <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Sales</a>
        <span style="color:grey;font-size:10px">></span>
        <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}">Car</a>
        <span class="pull-right">
          <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
          <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
          <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
        </span>
    </div>

    <br>
    <hr>

    @if ($carsale->reserves()->count() < 3)

      <div id="reservedlist">

        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Reserved List</div>
            <div class="panel-body" style="text-align:center">

              @if ($carsale->reserves()->count() == 1)
                  1 Person has already reserved this car! 2 More spots left!<br><br>
                  Quickly grab the last spots!
              @elseif ($carsale->reserves()->count() == 2)
                  2 people have already reserved this car! 2 More spot left!<br><br>
                  Quickly grab this last spot!
              @endif

            </div>
          </div>
        </div>

      </div>

    @endif

    <div class="col-md-12">
      <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
        <div class="panel-body">
          <div class="col-md-3">
              <ul id="lightSlider">

                  @foreach ($carsale->car->images as $image)

                    <li data-thumb="{{ asset($image->img_url) }}">
                        <a href="{{ asset($image->img_url) }}" data-lightbox="image"><img class="img-responsive" src="{{ asset($image->img_url) }}" /></a>
                    </li>

                  @endforeach

              </ul>
          </div>
          <div class="col-md-9">

              @allowed('corporate.user', $corporate)

                @role('sales|administrator')
                  
                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              Options <span class="caret"></span>
                          </span>

                          <ul class="dropdown-menu" role="menu">
                              @if ($carsale->negotiable == true)
                                <li id="negotiable"><a href="{{ url('/user') }}"><i class="fa fa-btn fa-ticket"></i> Reserve</a></li>
                              @endif
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-edit"></i> Edit</a></li>
                          </ul>
                      </li>
                  </ul>

                @endrole

              @endallowed

            <p>
              <strong>{{ $carsale->car->make }} {{ $carsale->car->model }}</strong>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <span class="label label-danger" style="font-size:16px">
                sale
              </span>
              &nbsp;&nbsp;
              <span style="font-size:20px">
                K{{ number_format($carsale->price, 2, '.', ',') }}
              </span>
              <span style="font-size:10px;color:grey">
                @if ($carsale->negotiable == 1)
                  negotiable
                @else 
                  not negotiable
                @endif
              </span>
            </p>
            <p>{{ $carsale->car->note }}</p>
            <p>{{ $carsale->note }}</p>

            @if ($carsale->cargroup_id)
              <p>
                In group <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$carsale->cargroup_id) }}"><span class="label label-primary">go to group</span></a> 
              </p>
            @endif

            <p>
              <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $carsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
            </p>
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
  });

  var carsale_cargroup_id = 0;
  var cargroup_url = '';

  @if ($carsale->cargroup_id)
      carsale_cargroup_id = {{ $carsale->cargroup_id }} ;
      cargroup_url = "{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$carsale->cargroup_id) }}";
  @endif

  var carsale_array = [
                          'id':{{ $carsale->id }}, 
                          'negotiable':{{ $carsale->negotiable }},
                          'price':{{ $carsale->price }},
                          'status':{{ $carsale->status }},
                          'note':{{ $carsale->note }},
                          'comments_url':{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/comments') }},
                          'offers_url':{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/offers') }},
                          'tails_url':{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }},
                      ]

  var car_array = [
                      'plates':{{ $carsale->car->plates }}, 
                      'color':{{ $carsale->car->color }},
                      'weight':{{ $carsale->car->weight }},
                      'datebought':{{ $carsale->car->datebought }},
                      'make':{{ $carsale->car->make }},
                      'model':{{ $carsale->car->model }},
                      'bodytype':{{ $carsale->car->bodytype }},
                      'published':{{ $carsale->car->published }},
                      'physicallocation':{{ $carsale->car->physicallocation }},
                      'ingroup':{{ $carsale->car->ingroup }},
                      'status':{{ $carsale->car->status }},
                      'note':{{ $carsale->car->note }}
                  ]

  var car_images = [ 
                        @foreach ($carsale->car->images as $image)
                            "{ asset($image->img_url) }}",
                        @endforeach     
                    ]

  var corporate_array = [
                            'id':{{ $corporate->id }},
                            'name':{{ $corporate->name }},
                            'cars_url':{{ url('/corporate/'.$corporate->id.'/cars') }}
                        ]


  

  function ajaxupdatecarsale() { 
      $.ajax({
          url: "{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/ajaxupdatecarsale') }}",
          type: "GET",
          async: false,
          success: function(data) {
              if (data.length > 0) {

                  // Check for carsale status = purchased
                  if (data.carsale_status == 'purchased') {

                  }
                      
              } else {
                  $('#errors').html(data.message);
              }

              setTimeout(function() {
                  get_fb();
              }, 10000); 
          }
      });
  }

  </script>
@endsection
