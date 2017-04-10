@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Sales</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Sales <img src="{{ asset('/imgs/land_sales.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

              @foreach ($carsales as $carsale)
                <tr> 
                  <td><img class="img-thumb" src="{{ $carsale->car->images()->first()->thumb_img_url }}"></td> <!-- Add multi slide image preview JS -->
                  <td>
                    <p>
                      <strong>
                        {{ $carsale->car->make }} {{ $carsale->car->model }}
                        &nbsp;&nbsp;&nbsp;
                        @if ($carsale->cargroup)
                          <span class="badge">Group {{ $carsale->cargroup->title }}</span>
                        @endif
                      </strong>
                    </p>
                    <p>{{ $carsale->car->note }}</p>
                    <p>{{ $carsale->note }}</p>
                    <p>
                      <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/offers') }}"><span style="color:gray;font-size:11px">{{ $carsale->offers()->count() }}  <i class="fa fa-money"></i></span></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carsale->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                    </p>
                  </td> 
                  <td style="font-size:11px;color:grey">{{ $carsale->created_at->format('l jS F Y') }}</td> 
                  <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id) }}" class="label label-primary">view</a></td>
                </tr> 
              @endforeach

              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
