@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('corp-part')

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts') }}">Parts</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales/groups') }}">Groups</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales/groups/group') }}">Group</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <h3>{{ $partgroup->title }}</h3>
          <hr>
          <p>
            <strong>
              {{ $partsales->count() }} parts. 

              @if ($partgroup->updated_at)
                Updated {{ $partgroup->updated_at->diffForHumans() }}.
              @endif
            </strong>
          </p>
        </div>

        @foreach ($partsales as $partsale)

          <div class="col-md-4">
            <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/groups/group/'.$partgroup->id.'/part/'.$partsale->id) }}">
              <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
                <div class="panel-body" style="padding:0;margin:0">
                  <div class="col-md-12"><img class="img-responsive" src="{{ $partsale->part->images()->first()->img_url }}"></div>
                  <div class="col-md-12" style="padding:10px;">
                    <p><strong>{{ $partsale->make }} {{ $partsale->part->model }}</strong></p>
                    <p>{{ $partsale->note }}</p>
                    <p>
                      <span style="color:gray;font-size:11px">{{ $partsale->part->comments()->count() }}  <i class="fa fa-comment-o"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $partsale->offers()->count() }}  <i class="fa fa-money"></i></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <span style="color:gray;font-size:11px">{{ $partsale->part->tails()->count() }}  <i class="fa fa-eye"></i></span>
                    </p>
                  </div> 
                </div>
              </div>
            </a>
          </div>

        @endforeach
  
@endsection
