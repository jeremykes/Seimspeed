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
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Groups <img src="/imgs/traffic_jam.png" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 

                @foreach ($groups as $group)
                
                  <tr> 
                    <td><img class="img-responsive" src="{{ asset('/imgs/mypart.png') }}"></td>
                    <td>
                      <p><strong>{{ $group->title }}</strong> <span class="label label-danger">group</span><span class="pull-right"><span class="label label-default">{{ $group->sales()->count() }} parts</span></span></p>
                      <p>{{ $group->descript }}</p>
                    </td> 
                    <td style="font-size:11px;color:grey">started {{ $group->startdate->diffForHumans() }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/groups/group/'.$group->id) }}" class="label label-primary">view</a></td>
                  </tr> 

                @endforeach
                
              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
