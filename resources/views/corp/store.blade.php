@extends('corp.layouts.app')


@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.css') }}">

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

	<div class="col-md-12" style="padding-left:1px;padding-right:1px">
		<div class="panel panel-danger">
			<div class="panel-heading">
				Reserved
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-bordered" id="opentrades">
					<thead>
						<tr>
							<th>Car/Part</th>
							<th>Type</th>
							<th>Price/Rate</th>
							<th>Offers/Bids/Tenders</th>
							<th>Created</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($reservedcarsales as $carsale)

								<tr>
									<td>{{ $carsale->car->make }} {{ $carsale->car->model }} {{ $carsale->car->fueltype }}</td>
									<td>sale</td>
									<td>K{{ number_format($carsale->price, 2) }}</td>
									<td>{{ count($carsale->offers) }}</td>
									<td>{{ $carsale->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($reservedcarrents as $carrent)

								<tr>
									<td>{{ $carrent->car->make }} {{ $carrent->car->model }} {{ $carrent->car->fueltype }}</td>
									<td>rent</td>
									<td>K{{ number_format($carrent->rateperday, 2) }}</td>
									<td>{{ count($carrent->offers) }}</td>
									<td>{{ $carrent->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($reservedcartenders as $cartender)

								<tr>
									<td>{{ $cartender->car->make }} {{ $cartender->car->model }} {{ $cartender->car->fueltype }}</td>
									<td>tender</td>
									<td> - </td>
									<td>{{ count($cartender->tenders) }}</td>
									<td>{{ $cartender->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($reservedcarauctions as $carauction)

								<tr>
									<td>{{ $carauction->car->make }} {{ $carauction->car->model }} {{ $carauction->car->fueltype }}</td>
									<td>auction</td>
									<td> - </td>
									<td>{{ count($carauction->bids) }}</td>
									<td>{{ $carauction->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($reservedpartsales as $partsale)

								<tr>
									<td>{{ $partsale->part->name }} {{ $partsale->part->serialnumber }}</td>
									<td>sale</td>
									<td>K{{ number_format($partsale->price, 2) }}</td>
									<td>{{ count($partsale->offers) }}</td>
									<td>{{ $partsale->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $partsale->part->id . '/partsale/' . $partsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>	

	<div class="col-md-12" style="padding-left:1px;padding-right:1px"><hr></div>
	
	<div class="col-md-12" style="padding-left:1px;padding-right:1px">
		<div class="panel panel-primary">
			<div class="panel-heading">
				All open items
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-bordered" id="opentrades">
					<thead>
						<tr>
							<th>Car/Part</th>
							<th>Type</th>
							<th>Price/Rate</th>
							<th>Offers/Bids/Tenders</th>
							<th>Created</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($opencarsales as $carsale)

								<tr>
									<td>{{ $carsale->car->make }} {{ $carsale->car->model }} {{ $carsale->car->fueltype }}</td>
									<td>sale</td>
									<td>K{{ number_format($carsale->price, 2) }}</td>
									<td>{{ count($carsale->offers) }}</td>
									<td>{{ $carsale->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carsale->car->id . '/carsale/' . $carsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencarrents as $carrent)

								<tr>
									<td>{{ $carrent->car->make }} {{ $carrent->car->model }} {{ $carrent->car->fueltype }}</td>
									<td>rent</td>
									<td>K{{ number_format($carrent->rateperday, 2) }}</td>
									<td>{{ count($carrent->offers) }}</td>
									<td>{{ $carrent->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carrent->car->id . '/carrent/' . $carrent->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencartenders as $cartender)

								{{ $cartender->id }}

								<tr>
									<td>{{ $cartender->car->make }} {{ $cartender->car->model }} {{ $cartender->car->fueltype }}</td>
									<td>tender</td>
									<td> - </td>
									<td>{{ count($cartender->tenders) }}</td>
									<td>{{ $cartender->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $cartender->car->id . '/cartender/' . $cartender->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($opencarauctions as $carauction)

								<tr>
									<td>{{ $carauction->car->make }} {{ $carauction->car->model }} {{ $carauction->car->fueltype }}</td>
									<td>auction</td>
									<td> - </td>
									<td>{{ count($carauction->bids) }}</td>
									<td>{{ $carauction->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $carauction->car->id . '/carauction/' . $carauction->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
								</tr>

						@endforeach

						@foreach($openpartsales as $partsale)

								<tr>
									<td>{{ $partsale->part->name }} {{ $partsale->part->serialnumber }}</td>
									<td>sale</td>
									<td>K{{ number_format($partsale->price, 2) }}</td>
									<td>{{ count($partsale->offers) }}</td>
									<td>{{ $partsale->created_at->diffForHumans() }}</td>
									<td><a href="{{ url('/corporate/'. $corporate->id .'/corpuser/car/' . $partsale->part->id . '/partsale/' . $partsale->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i></a></td>
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

<script src="{{ asset('DataTables/datatables.js') }}"></script>

<script>
	$(document).ready(function(){
	    $('#opentrades').DataTable();
	    $('#reservedtrades').DataTable();

	    $('#opentrades').DataTable().order([4, 'desc']).draw();
	    $('#reservedtrades').DataTable().order([4, 'desc']).draw();
	});
</script>

@endsection