@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
            <!-- <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="#">Add new car</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">unpublished cars</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">deleted cars</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">deleted groups</a>
            </span> -->
        </div>

        <br>

        <div class="col-md-12">
          <hr>
        </div>

        <div class="col-md-6">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Sales <img src="{{ asset('/imgs/land_sales.png') }}" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <div class="list-group" style="margin-bottom:0">
              <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales') }}" class="list-group-item" style="border-radius:0">Cars on sale <span class="label label-primary pull-right">
                @if ($countcarsonsale > 0) 
                  {{ $countcarsonsale }}
                @else
                  0
                @endif
              </span></a>
              <a href="{{ url('/corporate/'.$corporate->id.'/cars/reserves') }}" class="list-group-item" style="border-radius:0">Cars currently reserved <span class="label label-primary pull-right">
                @if ($countcarsonsalereserve > 0) 
                  {{ $countcarsonsalereserve }}
                @else
                  0
                @endif
              </span></a>
            </div> 
            <h4 style="padding:10px;">Sale Groups</h4>
            <table class="table table-bordered table-hover" style="margin-bottom:0"> 
              <tbody> 
                @foreach ($carsalegroups as $salegroup)
                  <tr> 
                    <td>{{ $salegroup->title }}</td> 
                    <td style="font-size:11px;color:grey">{{ $salegroup->updated_at->diffForHumans() }}</td> 
                    <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups/group/'.$salegroup->id) }}"><span class="label label-primary">view</span></a></td>
                  </tr> 
                @endforeach 
                  <tr> 
                    <td><a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/groups') }}">See all groups</a></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
              </tbody> 
            </table>
          </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Rents <img src="{{ asset('/imgs/car_rental.png') }}" style="height:40px;width:auto"> 
            </div>
            <div class="panel-body" style="padding:0;margin:0">
              <div class="list-group" style="margin-bottom:0">
                <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents') }}" class="list-group-item" style="border-radius:0">Rental cars <span class="label label-primary pull-right">
                  @if ($countcarsonrent > 0) 
                    {{ $countcarsonrent }}
                  @else
                    0
                  @endif
                </span></a>
                <a href="#" class="list-group-item" style="border-radius:0">Cars currently reserved <span class="label label-primary pull-right">
                  @if ($countcarsonrentreserve > 0) 
                    {{ $countcarsonrentreserve }}
                  @else
                    0
                  @endif
                </span></a>
              </div> 
              <h4 style="padding:10px;">Rental Groups</h4>
              <table class="table table-bordered table-hover" style="margin-bottom:0"> 
                <tbody> 
                  @foreach ($carrentgroups as $rentgroup)
                    <tr> 
                      <td>{{ $rentgroup->title }}</td> 
                      <td style="font-size:11px;color:grey">{{ $rentgroup->updated_at->diffForHumans() }}</td> 
                      <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/groups/group/'.$rentgroup->id) }}"><span class="label label-primary">view</span></a></td>
                    </tr> 
                  @endforeach  
                  <tr> 
                    <td><a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/groups') }}">See all groups</a></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
                </tbody> 
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Auctions <img src="{{ asset('/imgs/megaphone.png') }}" style="height:40px;width:auto"> 
            </div>
            <div class="panel-body" style="padding:0;margin:0">
              <div class="list-group" style="margin-bottom:0">
                <a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions') }}" class="list-group-item" style="border-radius:0">Cars on auction <span class="label label-primary pull-right">
                  @if ($countcarsonauction > 0) 
                    {{ $countcarsonauction }}
                  @else
                    0
                  @endif
                </span></a>
              </div> 
              <h4 style="padding:10px;">Auction Groups</h4>
              <table class="table table-bordered table-hover" style="margin-bottom:0"> 
                <tbody> 
                  @foreach ($carauctiongroups as $auctiongroup)
                    <tr> 
                      <td>{{ $auctiongroup->title }}</td> 
                      <td style="font-size:11px;color:grey">{{ $auctiongroup->updated_at->diffForHumans() }}</td> 
                      <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/groups/group/'.$auctiongroup->id) }}"><span class="label label-primary">view</span></a></td>
                    </tr> 
                  @endforeach  
                  <tr> 
                    <td><a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/groups') }}">See all groups</a></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
                </tbody> 
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Tenders <img src="{{ asset('/imgs/elections.png') }}" style="height:40px;width:auto"> 
            </div>
            <div class="panel-body" style="padding:0;margin:0">
              <div class="list-group" style="margin-bottom:0">
                <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders') }}" class="list-group-item" style="border-radius:0">Cars on tender <span class="label label-primary pull-right">
                  @if ($countcarsontender > 0) 
                    {{ $countcarsontender }}
                  @else
                    0
                  @endif
                </span></a>
              </div>
              <h4 style="padding:10px;">Tender Groups</h4>
              <table class="table table-bordered table-hover" style="margin-bottom:0"> 
                <tbody> 
                  @foreach ($cartendergroups as $tendergroup)
                    <tr> 
                      <td>{{ $tendergroup->title }}</td> 
                      <td style="font-size:11px;color:grey">{{ $tendergroup->updated_at->diffForHumans() }}</td> 
                      <td style="font-size:15px;"><a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/groups/group/'.$tendergroup->id) }}"><span class="label label-primary">view</span></a></td>
                    </tr> 
                  @endforeach  
                  <tr> 
                    <td><a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/groups') }}">See all groups</a></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
                </tbody> 
              </table> 
            </div>
          </div>
        </div>
        
@endsection
