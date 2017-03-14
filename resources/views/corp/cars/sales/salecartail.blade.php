@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')

    @if ($carsale->status == 'sold')
      <div class="col-md-12" style="text-align:center">
        <h2>This car has been sold.</h2>
        <hr>
        <h4>You can still check out wonderful cars on sale by <strong>{{ $corporate->name }}</strong> <a class="btn btn-success" href="{{ url('/corporate/'.$corporate->id.'/cars') }}">here</a></h4>
        <span style="color:gray;font-size:9px">The SeimSpeed Team</span>
      </div>

    @elseif ($carsale->status == 'reserved')

      @allowed('corporate.user', $corporate)

        @role('sales|administrator')

          <div class="col-md-12">
              <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}">Back</a>&nbsp;&nbsp;
              <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Sales</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}">Car</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }}">Tails</a>
              <span class="pull-right">
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
              </span>
          </div>

          <br>
          <hr>

          <div class="col-md-12">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body">
                <div class="col-md-3"><img class="img-responsive" src="{{ $carsale->car->images()->first()->img_url }}"></div>
                <div class="col-md-9">
                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              Options <span class="caret"></span>
                          </span>

                          <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i> Sold</a></li>
                              <li><a href="{{ url('/corporate/cars') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                          </ul>
                      </li>
                  </ul>
                  <p><strong>{{ $carsale->car->make }}</strong></p>
                  <p>{{ $carsale->car->note }}</p>
                  <p>{{ $carsale->note }}</p>
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
            <div class="list-group" style="padding-top:0;margin-top:0">

              @foreach ($tails as $tail)

                <div class="list-group-item col-md-12">
                  <div class="col-md-12" style="padding:10px;">
                    <img src="{{ asset($tail->user->propic) }}" style="height:50px;width:auto"> 
                    <strong>{{ $tail->user->name }}</strong> 
                    <span class="pull-right"><span style="color:gray;font-size:11px">{{ $tail->created_at->diffForHumans() }}</span></span>
                  </div>
                </div>

              @endforeach

            </div>
          </div>

        @endrole

      @endallowed

    @elseif ($carsale->status == 'sale')

          <div class="col-md-12">
              <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}">Back</a>&nbsp;&nbsp;
              <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Sales</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}">Car</a>
              <span style="color:grey;font-size:10px">></span>
              <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }}">Tails</a>
              <span class="pull-right">
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
                <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
              </span>
          </div>

          <br>
          <hr>

          <div class="col-md-12">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body">
                <div class="col-md-3"><img class="img-responsive" src="{{ $carsale->car->images()->first()->img_url }}"></div>
                <div class="col-md-9">

                  @allowed('corporate.user', $corporate)

                    @role('maintainer|sales|administrator')
                      
                      <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  Options <span class="caret"></span>
                              </span>

                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i> Sold</a></li>
                                  <li><a href="{{ url('/corporate/cars') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                                  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                                  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                              </ul>
                          </li>
                      </ul>

                    @endrole

                  @endallowed
                  
                  <p><strong>{{ $carsale->car->make }}</strong></p>
                  <p>{{ $carsale->car->note }}</p>
                  <p>{{ $carsale->note }}</p>
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
            <div class="list-group" style="padding-top:0;margin-top:0">

              @foreach ($tails as $tail)

                <div class="list-group-item col-md-12">
                  <div class="col-md-12" style="padding:10px;">
                    <img src="{{ asset($tail->user->propic) }}" style="height:50px;width:auto"> 
                    <strong>{{ $tail->user->name }}</strong> 
                    <span class="pull-right"><span style="color:gray;font-size:11px">{{ $tail->created_at->diffForHumans() }}</span></span>
                  </div>
                </div>

              @endforeach

            </div>
          </div>

    @endif
        
@endsection
