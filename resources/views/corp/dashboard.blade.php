@extends('corp.layouts.app')


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection


@section('dashboard-tab')
<div role="tab-panel" class="tab-pane active" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane" id="settings">
@endsection



@section('dashboard-content')

<div class="col-md-12">
	<div class="col-md-12"><br></div>

	<div class="col-md-12">
		<div class="col-md-6" style="font-size:12px">
			<h4>Totals</h4>
			<p><strong>Cars sold</strong>: </p>  
			<p><strong>Cars rented</strong>: </p>  
			<p><strong>Parts sold</strong>: </p>  
			<p><strong>Comments</strong>: </p>  
			<p><strong>Tails</strong>: </p>  
			<p><strong>Offers, bids and tenders</strong>: </p>  
		</div>

		<div class="col-md-6" style="font-size:12px">
			<h4>This month</h4>
			<p><strong>Cars sold</strong>: </p>  
			<p><strong>Cars rented</strong>: </p>  
			<p><strong>Parts sold</strong>: </p>  
			<p><strong>Comments</strong>: </p>  
			<p><strong>Tails</strong>: </p>  
			<p><strong>Offers, bids and tenders</strong>: </p> 
		</div>

		<div class="col-md-12">
			<hr>
		</div>
	</div>

	<div class="col-md-6" style="padding-left:3px;padding-right:3px;">
		<div class="panel panel-primary" style="margin-bottom:10px;">
			<div class="panel-heading">Car sales activity</div>
			<div class="panel-body">
				<h4>Graph not set up</h4>
			</div>	
		</div>
	</div>

	<div class="col-md-6" style="padding-left:3px;padding-right:3px;">
		<div class="panel panel-primary" style="margin-bottom:10px;">
			<div class="panel-heading">Part sales activity</div>
			<div class="panel-body">
				<h4>Graph not set up</h4>
			</div>	
		</div>
	</div>

	<div class="col-md-6" style="padding-left:3px;padding-right:3px;">
		<div class="panel panel-primary" style="margin-bottom:10px;">
			<div class="panel-heading">Car rents activity</div>
			<div class="panel-body">
				<h4>Graph not set up</h4>
			</div>	
		</div>
	</div>

	<div class="col-md-6" style="padding-left:3px;padding-right:3px;">
		<div class="panel panel-primary" style="margin-bottom:10px;">
			<div class="panel-heading">Car tenders activity</div>
			<div class="panel-body">
				<h4>Graph not set up</h4>
			</div>	
		</div>
	</div>

	<div class="col-md-6" style="padding-left:3px;padding-right:3px;">
		<div class="panel panel-primary" style="margin-bottom:10px;">
			<div class="panel-heading">Car auctions activity</div>
			<div class="panel-body">
				<h4>Graph not set up</h4>
			</div>	
		</div>
	</div>

</div>

@endsection