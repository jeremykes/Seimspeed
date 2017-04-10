@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')

    @if ($carrent->status == 'onrent')
      <div class="col-md-12" style="text-align:center">
        <h2>This car is currently on rent.</h2>
        <hr>
        <h4>You can still check out wonderful cars on rent by <strong>{{ $corporate->name }}</strong> <a class="btn btn-success" href="{{ url('/corporate/'.$corporate->id.'/cars') }}">here</a></h4>
        <span style="color:gray;font-size:9px">The SeimSpeed Team</span>
      </div>

    @elseif ($carrent->status == 'reserved')

      @allowed('corporate.user', $corporate)

        @role('sales|administrator')

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/rentals') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/rentals') }}">Rentals</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/rentals/car') }}">Car</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals') }}">Rentals</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <div class="panel-body">
              <div class="col-md-3"><img class="img-responsive" src="/imgs/mycar.png"></div>
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
                <p><strong>{{ $carrent->car->make }}</strong></p>
                <p>{{ $carrent->car->note }}</p>
                <p>{{ $carrent->note }}</p>
                <p>
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carrent->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $carrent->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carrent->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
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

    @elseif ($carrent->status == 'rent')

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/rentals') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/rentals') }}">Rentals</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/rentals/car') }}">Car</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals') }}">Rentals</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/rentals/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <div class="panel-body">
              <div class="col-md-3"><img class="img-responsive" src="/imgs/mycar.png"></div>
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

                <p><strong>{{ $carrent->car->make }}</strong></p>
                <p>{{ $carrent->car->note }}</p>
                <p>{{ $carrent->note }}</p>
                <p>
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carrent->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $carrent->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$carrent->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carrent->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
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
