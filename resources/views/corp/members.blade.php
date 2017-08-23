@extends('corp.layouts.app')


@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.css') }}">

@endsection


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection



@section('dashboard-tab')
<div role="tab-panel" class="tab-pane" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane active" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane" id="settings">
@endsection



@section('members-content')

<div class="col-md-12">
	
	<div class="col-md-12"><br></div>

	<div class="col-md-12">
		<a href="{{ url('/corporate/' . $corporate->id . '/corpuser/maintainer/addcorporateuserform') }}" class="btn btn-xs btn-primary">add member</a>
	</div>

	<div class="col-md-12"><br></div>

	<div class="col-md-12" style="padding-left:1px;padding-right:1px">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Members
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-bordered" id="member">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Title</th>
							<th>Roles</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						@foreach($corporateusers as $corporateuser)

								<tr>
									<td>{{ $corporateuser->user->name }}</td>
									<td>{{ $corporateuser->user->email }}</td>
									<td>{{ $corporateuser->title }}</td>
									<td>
										@foreach ($corporateuser->user->roles as $role)
											<span style="font-size:9px;" class="label label-default">{{ $role->display_name }}</span>&nbsp;&nbsp;
										@endforeach
									</td>
									<td><a href="{{ url('/corporate/' . $corporate->id .'/corpuser/maintainer/updatecorporateuserform/' . $corporateuser->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a></td>
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
	    $('#member').DataTable();
	});
</script>

@endsection