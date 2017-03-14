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
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Sales <img src="{{ asset('imgs/land_sales.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

              @foreach ($partsales as $partsale)
                <tr> 
                  <td><img class="img-thumb" src="{{ $partsale->part->images()->first()->thumb_img_url }}"></td> <!-- Add multi slide image preview JS -->
                  <td>
                    <p>
                      <strong>
                        {{ $partsale->part->make }} {{ $partsale->part->model }}
                        &nbsp;&nbsp;&nbsp;
                        @if ($partsale->partgroup)
                          <span class="badge">Group {{ $partsale->partgroup->title }}</span>
                        @endif
                      </strong>
                    </p>
                    <p>{{ $partsale->part->note }}</p>
                    <p>{{ $partsale->note }}</p>
                    <p>
                      <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $partsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $partsale->part->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                    </p>
                  </td> 
                  <td style="font-size:11px;color:grey">{{ $partsale->created_at->format('l jS F Y') }}</td> 
                  <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$partsale->id) }}" class="label label-primary">view</a></td>
                </tr> 
              @endforeach

              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
