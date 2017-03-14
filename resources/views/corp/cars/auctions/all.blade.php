@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/auctions') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/auctions') }}">Auctions</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions') }}">Auctions</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
          This panel show you all responses from customers or potential buys. You are required to respond to these.
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Auctions <img src="{{ asset('imgs/megaphone.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

                @foreach ($carauctions as $carauction)

                  <tr> 
                    <td><img class="img-thumb" src="{{ $carauction->car->images()->first()->thumb_img_url }}"></td> <!-- Add multi slide image preview JS -->
                    <td>
                      <p>
                        <strong>
                          {{ $carauction->car->make }} {{ $carauction->car->model }}
                          &nbsp;&nbsp;&nbsp;
                          @if ($carauction->cargroup)
                            <span class="badge">Group {{ $carauction->cargroup->title }}</span>
                          @endif
                        </strong>
                      </p>
                      <p>{{ $carauction->car->note }}</p>
                      <p>{{ $carauction->note }}</p>
                      <p>
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/auction/'.$carauction->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $carauction->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/auction/'.$carauction->id.'/bids') }}"><span style="color:gray;font-size:11px">{{ $carauction->bids()->count() }}  <i class="fa fa-money"></i></span></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/auction/'.$carauction->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $carauction->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                      </p>
                    </td> 
                    <td style="font-size:11px;color:grey">{{ $carauction->created_at->format('l jS F Y') }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/auction/'.$carauction->id) }}" class="label label-primary">view</a></td>
                  </tr> 

                @endforeach

              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
