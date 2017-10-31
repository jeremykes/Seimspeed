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

	<div class="col-md-12" style="height:300px;position:relative;">
		<h3>Welcome to your dashboard!</h3>
		<hr>
		<br>
		<p>Please use the tabs above to navigate through the site.</p>
		<p>For any enquiries or issues with the site, please feel free to contact us immediately on 76074402 or email <a href="mailto:admin@skoonters.com" target="_top">admin@skoonters.com</a></p>
		<p style="position:absolute;bottom:0;font-size:10px">Powered by <span style="color:gray;"><a href="http://www.skoonters.com" title="Skoonters Website Development Gurus">Skoonters</a> Ltd</span>.</p>
	</div>

</div>

@endsection