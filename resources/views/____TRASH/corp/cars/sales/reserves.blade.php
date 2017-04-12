@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')

  @allowed('corporate.user', $corporate)

    @role('sales|administrator')

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Reserved <img src="{{ asset('/imgs/deliver_food.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

              @foreach ($reserves as $reserve)

                <tr> 
                  <td><img class="img-responsive" src="{{ $reserve->carsale->car->images()->first()->thumb_img_url }}"></td>
                  <td>
                    <p><strong>{{ $reserve->carsale->car->make.' '.$reserve->carsale->car->model }}</strong> reserved by <a href="#">{{ $reserve->carsaleoffer->user->name }}</a></p>
                    <p>{{ $reserve->note }}</p>
                    <p><span style="color:gray;font-size:11px">{{ $reserve->carsale->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">{{ $reserve->carsale->offers()->count() }}  <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">{{ $reserve->carsale->car->tails()->count() }}  <i class="fa fa-eye"></i></span></p>
                  </td> 
                  <td style="font-size:11px;color:grey">{{ $reserve->created_at->diffForHumans() }}</td> 
                  <td style="font-size:15px;"><a href="{{ url('corporate/'.$corporate->id.'/cars/sales/sale/'.$reserve->carsale->id.'/reserves/car') }}" class="label label-primary">view</a></td>
                </tr> 

              @endforeach
              
              </tbody> 
            </table>
          </div>
          </div>
        </div>

    @endrole

  @endallowed
        
@endsection