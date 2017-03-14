@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('corp-part')
		    <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories') }}">Parts &amp; Accessories</a>
            <!-- <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="#">Add new part or accessories</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">deleted groups</a>
            </span> -->
        </div>

        <br>
          
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Sales <img src="{{ asset('imgs/land_sales.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <div class="list-group" style="margin-bottom:0">
              <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales') }}" class="list-group-item" style="border-radius:0">parts on sale <span class="label label-primary pull-right">
                @if ($countpartsonsale > 0) 
                  {{ $countpartsonsale }}
                @else
                  0
                @endif
              </span></a>
              <a href="{{ url('/corporate/'.$corporate->id.'/parts/reserves') }}" class="list-group-item" style="border-radius:0">parts currently reserved <span class="label label-primary pull-right">
                @if ($countpartsonsalereserve > 0) 
                  {{ $countpartsonsalereserve }}
                @else
                  0
                @endif
              </span></a>
            </div> 
            <h4 style="padding:10px;">Sale Groups</h4>
            <table class="table table-bordered table-hover" style="margin-bottom:0"> 
              <tbody> 
                @foreach ($partsalegroups as $salegroup)
                  <tr> 
                    <td>{{ $salegroup->title }}</td> 
                    <td style="font-size:11px;color:grey">{{ $salegroup->updated_at->diffForHumans() }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/groups/group/'.$salegroup->id) }}"><span class="label label-primary">view</span></a></td>
                  </tr> 
                @endforeach 
                  <tr> 
                    <td><a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/groups') }}">See all groups</a></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
              </tbody> 
            </table>
          </div>
          </div>
        </div>

@endsection
