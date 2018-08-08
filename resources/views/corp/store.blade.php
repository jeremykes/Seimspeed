@extends('corp.layouts.app')


@section('css')

<!-- <link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables-theme/material.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables-theme/dataTables.material.min.css') }}">

@endsection


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection



@section('dashboard-tab')
<div role="tab-panel" class="tab-pane" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane active" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane" id="settings">
@endsection




@section('store-content')

<div class="col-md-12">

	<div class="col-md-12"><br></div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Reserved Sales and Auctions <i style="bottom: 3px;cursor: pointer;" onclick="toggleAdvancedTable('rsa_table')" class="fa fa-angle-double-down pull-right"></i>
			</div>
			<div class="panel-body">

				<table class="table table-responsive searchoff" id="rsa_table">
					<thead id="rsa_tableHeader" style="display: none;">
						<tr>
							<th>Image</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($reservedcarsales as $carsale)
							
							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carsale->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}">
										{{ $carsale->car->make }} {{ $carsale->car->model }} <label class="label label-danger">SALE</label> going for <strong>K{{ number_format($carsale->price, 2) }}</strong>.
									</a>
								</td>
							</tr>
				
						@endforeach

						@foreach($reservedcarrents as $carrent)

							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carrent->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}">
										{{ $carrent->car->make }} {{ $carrent->car->model }} <label class="label label-danger">RENT</label> going for <strong>K{{ number_format($carrent->price, 2) }}</strong>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedcartenders as $cartender)

							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $cartender->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}">
										{{ $cartender->car->make }} {{ $cartender->car->model }} <label class="label label-danger">TENDER</label>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedcarauctions as $carauction)

							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carauction->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}">
										{{ $carauction->car->make }} {{ $carauction->car->model }} <label class="label label-danger">auction</label>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedpartsales as $partsale)

							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/part/' . $partsale->part->id . '/partsale/' . $partsale->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $partsale->part->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/part/' . $partsale->part->id . '/partsale/' . $partsale->id) }}">
										{{ $partsale->part->name }} <label class="label label-danger">SALE</label> going for <strong>K{{ number_format($partsale->price, 2) }}</strong>.
									</a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>	

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Rental <i style="bottom: 3px;cursor: pointer;" onclick="toggleAdvancedTable('rental_table')" class="fa fa-angle-double-down pull-right"></i>
			</div>
			<div class="panel-body">

				<table class="table table-responsive searchoff" id="rental_table">
					<thead id="rental_tableHeader" style="display: none;">
						<tr>
							<th>Image</th>
							<th></th>
						</tr>
					</thead>

					<tbody>

						@foreach($reservedcarsales as $carsale)
							
							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carsale->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}">
										{{ $carsale->car->make }} {{ $carsale->car->model }} <label class="label label-danger">SALE</label> going for <strong>K{{ number_format($carsale->price, 2) }}</strong>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedcarrents as $carrent)
	
							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carrent->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}">
										{{ $carrent->car->make }} {{ $carrent->car->model }} <label class="label label-danger">RENT</label> going for <strong>K{{ number_format($carrent->price, 2) }}</strong>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedcartenders as $cartender)
							
							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $cartender->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}">
										{{ $cartender->car->make }} {{ $cartender->car->model }} <label class="label label-danger">TENDER</label>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedcarauctions as $carauction)

							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $carauction->car->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}">
										{{ $carauction->car->make }} {{ $carauction->car->model }} <label class="label label-danger">auction</label>.
									</a>
								</td>
							</tr>

						@endforeach

						@foreach($reservedpartsales as $partsale)
							
							<tr>
								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/part/' . $partsale->part->id . '/partsale/' . $partsale->id) }}">
										<img style="height: 30px;width: auto;" src="{{ $partsale->part->images->first()->img_url }}"> 
									</a>
								</td>

								<td class="noTableRowBorder">
									<a href="{{ url('/corporate/'. $corporate->id .'/corpuser/part/' . $partsale->part->id . '/partsale/' . $partsale->id) }}">
										{{ $partsale->part->name }} <label class="label label-danger">SALE</label> going for <strong>K{{ number_format($partsale->price, 2) }}</strong>.
									</a>
								</td>
							</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				All <i style="bottom: 3px;cursor: pointer;" onclick="toggleAdvancedTable('all_table')" class="fa fa-angle-double-down pull-right"></i>
			</div>
			<div class="panel-body">
				<table class="table table-responsive searchoff" id="all_table">
					<thead id="all_tableHeader" style="display: none;">
						<tr>
							<th>Car/Part</th>
							<th>Type</th>
							<th>Price/Rate</th>
							<th>Offers/Bids/Tenders</th>
							<th>Created</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($opencarsales as $carsale)

								<tr>
									<td class="noTableRowBorder">{{ $carsale->car->make }} {{ $carsale->car->model }} {{ $carsale->car->fueltype }}</td>
									<td class="noTableRowBorder">sale</td>
									<td class="noTableRowBorder">K{{ number_format($carsale->price, 2) }}</td>
									<td class="noTableRowBorder">{{ count($carsale->offers) }}</td>
									<td class="noTableRowBorder">{{ $carsale->created_at->diffForHumans() }}</td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/car/updatesaleform/' . $carsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencarrents as $carrent)

								<tr>
									<td class="noTableRowBorder">{{ $carrent->car->make }} {{ $carrent->car->model }} {{ $carrent->car->fueltype }}</td>
									<td class="noTableRowBorder">rent</td>
									<td class="noTableRowBorder">K{{ number_format($carrent->rateperday, 2) }}</td>
									<td class="noTableRowBorder">{{ count($carrent->offers) }}</td>
									<td class="noTableRowBorder">{{ $carrent->created_at->diffForHumans() }}</td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/car/updaterentform/' . $carrent->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencartenders as $cartender)

								<tr>
									<td class="noTableRowBorder">{{ $cartender->car->make }} {{ $cartender->car->model }} {{ $cartender->car->fueltype }}</td>
									<td class="noTableRowBorder">tender</td>
									<td class="noTableRowBorder"> - </td>
									<td class="noTableRowBorder">{{ count($cartender->tenders) }}</td>
									<td class="noTableRowBorder">{{ $cartender->created_at->diffForHumans() }}</td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/car/updatetenderform/' . $cartender->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencarauctions as $carauction)

								<tr>
									<td class="noTableRowBorder">{{ $carauction->car->make }} {{ $carauction->car->model }} {{ $carauction->car->fueltype }}</td>
									<td class="noTableRowBorder">auction</td>
									<td class="noTableRowBorder"> - </td>
									<td class="noTableRowBorder">{{ count($carauction->bids) }}</td>
									<td class="noTableRowBorder">{{ $carauction->created_at->diffForHumans() }}</td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/car/updateauctionform/' . $carauction->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($openpartsales as $partsale)

								<tr>
									<td class="noTableRowBorder">{{ $partsale->part->name }} {{ $partsale->part->serialnumber }}</td>
									<td class="noTableRowBorder">sale</td>
									<td class="noTableRowBorder">K{{ number_format($partsale->price, 2) }}</td>
									<td class="noTableRowBorder">{{ count($partsale->offers) }}</td>
									<td class="noTableRowBorder">{{ $partsale->created_at->diffForHumans() }}</td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/sales/part/updatesaleform/' . $partsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
									<td class="noTableRowBorder"><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/part/' . $partsale->part->id . '/partsale/' . $partsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

@endsection


@section('script')

<script src="{{ asset('datatables/datatables.js') }}"></script>

<script>
	$(document).ready(function(){
	    $('#rsa_table').DataTable({
	    	"paging": false,
	    	"ordering": false,
        	"info":     false,
        	"searching": false
	    });

	    $('#rental_table').DataTable({
	    	"paging": false,
	    	"ordering": false,
        	"info":     false,
        	"searching": false
	    });

	    $('#all_table').DataTable({
	    	"paging": false,
	    	"ordering": false,
	    	"info": false,
	    	"searching": false
	    });
	});

</script>

@endsection