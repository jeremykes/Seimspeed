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
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/auctions/groups') }}">Groups</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions') }}">Auctions</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/auctions/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Groups <img src="{{ asset('imgs/traffic_jam.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

                @foreach ($groups as $group)
                
                  <tr> 
                    <td><img class="img-responsive" src="{{ asset('/imgs/mycar.png') }}"></td>
                    <td>
                      <p><strong>{{ $group->title }}</strong> <span class="label label-danger">group</span><span class="pull-right"><span class="label label-default">{{ $group->auctions()->count() }} cars</span></span></p>
                      <p>{{ $group->descript }}</p>
                    </td> 
                    <td style="font-size:11px;color:grey">started {{ $group->startdate->diffForHumans() }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/groups/group/'.$group->id) }}" class="label label-primary">view</a></td>
                  </tr> 

                @endforeach

              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
