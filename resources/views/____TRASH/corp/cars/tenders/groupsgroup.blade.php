@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/tenders') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/tenders') }}">Tenders</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/tenders/groups') }}">Groups</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/tenders/groups/group') }}">Group</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders') }}">Tenders</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <h3>{{ $cargroup->title }}</h3>
          <hr>
          <p>
            <strong>
              {{ $cartenders->count() }} cars. 

              @if ($cargroup->updated_at)
                Updated {{ $cargroup->updated_at->diffForHumans() }}.
              @endif
            </strong>
          </p>
        </div>

        @foreach ($cartenders as $cartender)

          <div class="col-md-4">
            <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/groups/group/'.$cargroup->id.'/car/'.$cartender->id) }}">
              <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
                <div class="panel-body" style="padding:0;margin:0">
                  <div class="col-md-12"><img class="img-responsive" src="{{ $cartender->car->images()->first()->img_url }}"></div>
                  <div class="col-md-12" style="padding:10px;">
                    <p><strong>{{ $cartender->make }} {{ $cartender->car->model }}</strong></p>
                    <p>{{ $cartender->note }}</p>
                    <p>
                      <span style="color:gray;font-size:11px">{{ $cartender->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $cartender->tenders()->count() }}  <i class="fa fa-money"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $cartender->car->tails()->count() }}  <i class="fa fa-eye"></i></span>
                    </p>
                  </div> 
                </div>
              </div>
            </a>
          </div>

        @endforeach
  
@endsection
