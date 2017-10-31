@extends('corp.layouts.app')


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection



@section('dashboard-tab')
<div role="tab-panel" class="tab-pane" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane active" id="settings">
@endsection




@section('settings-content')

<div class="col-md-12">
	
	<div class="col-md-12">
		<h2>Settings <a href="{{ url('/corporate/' . $corporate->id . '/settings/edit') }}" class="btn btn-xs btn-default pull-right">Edit</a></h2>
	</div>

	<div class="col-md-12">

		<h4>Company Details</h4>

	<hr>

	    <p><strong>Name</strong>: {{ $corporate->name }}</p>
	    <p><strong>Address</strong>: {{ $corporate->address }}</p>
	    <p><strong>Phone</strong>: {{ $corporate->phone }}</p>
	    <p><strong>Description</strong>: {{ $corporate->descrip }}</p>

	    <p>
	    	<div class="col-md-12" style="padding:0">

	    	    <div class="col-md-12">
	    	    	<br><br>
	    	        <h4>Subscription Plan</h4>
	    	        <hr>
	    	    </div>

	    	    <div class="col-md-3" style="padding:1px">
	    	    	<h3 style="text-align:center"><span class="label label-info" id="basic-current"></span>&nbsp;</h3>
	    	        <div class="panel panel-primary">
	    	            <div class="panel-heading">
	    	                Basic Plan
	    	            </div>
	    	            <div id="basic-panel-body" class="panel-body" style="text-align:center">
	    	                <p>5 cars</p>
	    	                <p>10 parts</p>
	    	                <p>&nbsp;</p>
	    	                <p>&nbsp;</p>
	    	                <hr>
	    	                <h4>Free</h4>
	    	                <p id="btn-basic-plan">&nbsp;</p>
	    	            </div>
	    	        </div>
	    	    </div>

	    	    <div class="col-md-3" style="padding:1px">
	    	    	<h3 style="text-align:center"><span class="label label-info" id="small-current"></span>&nbsp;</h3>
	    	        <div class="panel panel-warning">
	    	            <div class="panel-heading">
	    	                Small Business Plan
	    	            </div>
	    	            <div id="small-panel-body" class="panel-body" style="text-align:center">
	    	                <p>20 cars</p>
	    	                <p>100 parts</p>
	    	                <p>Reports</p>
	    	                <p>&nbsp;</p>
	    	                <hr>
	    	                <h4>K300 <span style="font-size:10px;color:gray">/month</span></h4>
	    	                <p id="btn-basic-small">&nbsp;</p>
	    	            </div>
	    	        </div>
	    	    </div>

	    	    <div class="col-md-3" style="padding:1px">
	    	    	<h3 style="text-align:center"><span class="label label-info" id="business-current"></span>&nbsp;</h3>
	    	        <div class="panel panel-success">
	    	            <div class="panel-heading">
	    	                Business Plan
	    	            </div>
	    	            <div id="business-panel-body" class="panel-body" style="text-align:center">
	    	                <p>30 cars</p>
	    	                <p>200 parts</p>
	    	                <p>Detailed Reports</p>
	    	                <p>Monthly Statistics</p>
	    	                <hr>
	    	                <h4>K1,000 <span style="font-size:10px;color:gray">/month</span></h4>
	    	                <pid="btn-basic-business">&nbsp;</p>
	    	            </div>
	    	        </div>
	    	    </div>

	    	    <div class="col-md-3" style="padding:1px">
	    	    	<h3 style="text-align:center"><span class="label label-info" id="premium-current"></span>&nbsp;</h3>
	    	        <div class="panel panel-danger">
	    	            <div class="panel-heading">
	    	                Premium Plan
	    	            </div>
	    	            <div id="premium-panel-body" class="panel-body" style="text-align:center">
	    	                <p>Unlimited cars</p>
	    	                <p>Unlimited parts</p>
	    	                <p>Detailed Reports</p>
	    	                <p>Monthly Statistics</p>
	    	                <hr>
	    	                <h4>K3,000 <span style="font-size:10px;color:gray">/month</span></h4>
	    	                <p id="btn-basic-premium">&nbsp;</p>
	    	            </div>
	    	        </div>
	    	    </div>

	    	</div>    
	    </p>

	</div>

</div>

@endsection


@section('script')

<script>

	function setSub(currentSub) {
		$('#' + currentSub + '-current').html('CURRENT');
		$('#' + currentSub + '-panel-body').addClass('btn-info');
	}

	setSub('{{ $subscription->name }}');

</script>

@endsection