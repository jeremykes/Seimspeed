@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales/groups/group') }}">Group</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <h3>{{ $cargroup->title }}</h3>
          <hr>
          <p>
            <strong>
              {{ $carsales->count() }} cars. 

              @if ($cargroup->updated_at)
                Updated {{ $cargroup->updated_at->diffForHumans() }}.
              @endif
            </strong>
          </p>
        </div>

        @foreach ($carsales as $carsale)

          <div class="col-md-4">
            <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$cargroup->id.'/car/'.$carsale->id) }}">
              <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
                <div class="panel-body" style="padding:0;margin:0">
                  <div class="col-md-12"><img class="img-responsive" src="{{ $carsale->car->images()->first()->img_url }}"></div>
                  <div class="col-md-12" style="padding:10px;">
                    <p><strong>{{ $carsale->make }} {{ $carsale->car->model }}</strong></p>
                    <p>{{ $carsale->note }}</p>
                    <p>
                      <span style="color:gray;font-size:11px">{{ $carsale->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $carsale->offers()->count() }}  <i class="fa fa-money"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $carsale->car->tails()->count() }}  <i class="fa fa-eye"></i></span>
                    </p>
                  </div> 
                </div>
              </div>
            </a>
          </div>

        @endforeach
  
@endsection
