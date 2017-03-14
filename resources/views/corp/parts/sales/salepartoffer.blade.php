@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('corp-part')

    @if ($partsale->status == 'sold')
      <div class="col-md-12" style="text-align:center">
        <h2>This part has been sold.</h2>
        <hr>
        <h4>You can still check out wonderful parts on sale by <strong>{{ $corporate->name }}</strong> <a class="btn btn-success" href="{{ url('/corporate/'.$corporate->id.'/parts') }}">here</a></h4>
        <span style="color:gray;font-size:9px">The SeimSpeed Team</span>
      </div>

    @elseif ($partsale->status == 'reserved')

      @allowed('corporate.user', $corporate)

        @role('sales|administrator')

          <div class="col-md-12">
              <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id) }}">Back</a>&nbsp;&nbsp;
              <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts') }}">Parts</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales') }}">Sales</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id) }}">Part</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/offers') }}">Offers</a>
              <span class="pull-right">
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales') }}">Sales</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/groups') }}">Groups</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/reserves') }}">Reserved</a>
              </span>
          </div>

          <br>
          <hr>

          <div class="col-md-12">
            <!-- Just a note that this is for NEGOTIABLE sales only. -->
            
          </div>

          <div class="col-md-12">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body">
                <div class="col-md-12">
                  @if ($partsale->negotiable == 0)
                    <h5><strong style="font-size:18px;padding-right:15px">K{{ $partsale->price }}</strong> non-negotiable</h5>
                  @else
                    <h5><strong style="font-size:18px;padding-right:15px">K{{ $partsale->price }}</strong> negotiable</h5>
                  @endif
                </div>
                <div class="col-md-3"><img class="img-responsive" src="{{ $partsale->part->images()->first()->img_url }}"></div>
                <div class="col-md-9">
                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              Options <span class="partet"></span>
                          </span>

                          <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i> Sold</a></li>
                              <li><a href="{{ url('/corporate/parts') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                          </ul>
                      </li>
                  </ul>
                  <p><strong>{{ $partsale->part->make }}</strong></p>
                  <p>{{ $partsale->part->note }}</p>
                  <p>{{ $partsale->note }}</p>
                  <p>
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $partsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                  </p>
                </div> 
              </div>
            </div>

            @if ($partsale->negotiable == 1)

              <div class="list-group">
                <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
                  <div class="col-md-12">
                    <p>
                      <strong>Your offer</strong> 
                      <div class="input-group">
                        <span class="input-group-addon">K</span>
                        <input type="text" class="form-control" aria-label="Your offer">
                        <span class="input-group-addon">.00</span>
                      </div>
                      <div class="input-group">
                        <br>
                        <a class="btn btn-success btn-xs">Offer</a>
                      </div>
                    </p>
                  </div>
                </div>

                @foreach ($offers as $offer)

                  <div class="list-group-item col-md-12">
                    <div class="col-md-2">
                      <img class="img-responsive" src="{{ asset('/imgs/mypart.png') }}"> 
                    </div>
                    <div class="col-md-10">
                      <p><strong>{{ $offer->user->name }}</strong> <span class="pull-right"><span style="color:gray;font-size:11px">{{ $offer->created_at->diffForHumans() }}</span></span></p>
                      <p style="font-size:18px"><span class="label label-default">{{ $offer->offer }}</span></p>
                      <p class="pull-right">
                        <a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> 
                        <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> 
                        <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a>
                      </p>
                    </div>
                  </div>

                @endforeach

              </div>

            @else

              <div class="list-group">
                <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
                  <a href="#" class="btn btn-success">Offer</a>
                </div>
              </div>

            @endif

          </div>

        @endrole

      @endallowed

    @elseif ($partsale->status == 'sale')

          <div class="col-md-12">
              <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id) }}">Back</a>&nbsp;&nbsp;
              <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts') }}">Parts</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales') }}">Sales</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id) }}">Part</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/offers') }}">Offers</a>
              <span class="pull-right">
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales') }}">Sales</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/groups') }}">Groups</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/reserves') }}">Reserved</a>
              </span>
          </div>

          <br>
          <hr>

          <div class="col-md-12">
            <!-- Just a note that this is for NEGOTIABLE sales only. -->
            
          </div>

          <div class="col-md-12">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body">
                <div class="col-md-12">
                  @if ($partsale->negotiable == 0)
                    <h5><strong style="font-size:18px;padding-right:15px">K{{ $partsale->price }}</strong> non-negotiable</h5>
                  @else
                    <h5><strong style="font-size:18px;padding-right:15px">K{{ $partsale->price }}</strong> negotiable</h5>
                  @endif
                </div>
                <div class="col-md-3"><img class="img-responsive" src="{{ $partsale->part->images()->first()->img_url }}"></div>
                <div class="col-md-9">

                  @allowed('corporate.user', $corporate)

                    @role('maintainer|sales|administrator')
                      
                      <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  Options <span class="partet"></span>
                              </span>

                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i> Sold</a></li>
                                  <li><a href="{{ url('/corporate/parts') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                                  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                                  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                              </ul>
                          </li>
                      </ul>

                    @endrole

                  @endallowed

                  <p><strong>{{ $partsale->part->make }}</strong></p>
                  <p>{{ $partsale->part->note }}</p>
                  <p>{{ $partsale->note }}</p>
                  <p>
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $partsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                  </p>
                </div> 
              </div>
            </div>

            @if ($partsale->negotiable == 1)

              <div class="list-group">
                <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
                  <div class="col-md-12">
                    <p>
                      <strong>Your offer</strong> 
                      <div class="input-group">
                        <span class="input-group-addon">K</span>
                        <input type="text" class="form-control" aria-label="Your offer">
                        <span class="input-group-addon">.00</span>
                      </div>
                      <div class="input-group">
                        <br>
                        <a class="btn btn-success btn-xs">Offer</a>
                      </div>
                    </p>
                  </div>
                </div>

                @foreach ($offers as $offer)

                  <div class="list-group-item col-md-12">
                    <div class="col-md-2">
                      <img class="img-responsive" src="{{ asset('/imgs/mypart.png') }}"> 
                    </div>
                    <div class="col-md-10">
                      <p><strong>{{ $offer->user->name }}</strong> <span class="pull-right"><span style="color:gray;font-size:11px">{{ $offer->created_at->diffForHumans() }}</span></span></p>
                      <p style="font-size:18px"><span class="label label-default">{{ $offer->offer }}</span></p>
                      <p class="pull-right">

                        @allowed('corporate.user', $corporate)

                          @role('sales|administrator')

                            <a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> 
                            <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> 

                          @endrole

                          <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a>

                        @endallowed

                      </p>
                    </div>
                  </div>

                @endforeach

              </div>

            @else

              <div class="list-group">
                <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
                  <a href="#" class="btn btn-success">Offer</a>
                </div>
              </div>

            @endif

          </div>

    @endif
        
@endsection
