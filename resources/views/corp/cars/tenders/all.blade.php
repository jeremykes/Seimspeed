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
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders') }}">Tenders</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Tenders <img src="{{ asset('imgs/elections.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

                @foreach ($cartenders as $cartender)

                  <tr> 
                    <td><img class="img-thumb" src="{{ $cartender->car->images()->first()->thumb_img_url }}"></td> <!-- Add multi slide image preview JS -->
                    <td>
                      <p>
                        <strong>
                          {{ $cartender->car->make }} {{ $cartender->car->model }}
                          &nbsp;&nbsp;&nbsp;
                          @if ($cartender->cargroup)
                            <span class="badge">Group {{ $cartender->cargroup->title }}</span>
                          @endif
                        </strong>
                      </p>
                      <p>{{ $cartender->car->note }}</p>
                      <p>{{ $cartender->note }}</p>
                      <p>
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$cartender->id.'/comments') }}"><span style="color:gray;font-size:11px">{{ $cartender->car->comments()->count() }}  <i class="fa fa-comment-o"></i></span></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$cartender->id.'/tenders') }}"><span style="color:gray;font-size:11px">{{ $cartender->tenders()->count() }}  <i class="fa fa-money"></i></span></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$cartender->id.'/tails') }}"><span style="color:gray;font-size:11px">{{ $cartender->car->tails()->count() }}  <i class="fa fa-eye"></i></span></a>
                      </p>
                    </td> 
                    <td style="font-size:11px;color:grey">{{ $cartender->created_at->format('l jS F Y') }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$cartender->id) }}" class="label label-primary">view</a></td>
                  </tr> 

                @endforeach

              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
