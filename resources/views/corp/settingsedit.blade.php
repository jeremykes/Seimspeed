@extends('corp.layouts.app')

@section('css')
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/msdropdown/dd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection


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

		<form action="{{ url('/corporate/' . $corporate->id . '/corpuser/administrator/updatecorporate') }}" method="post">

			{!! csrf_field() !!}

			@include('common.errors')

			<p><strong>Name</strong>: <input class="form-control" type="text" name="name" id="name" value="{{ $corporate->name }}"></p>
		    <p><strong>Address</strong>: <input class="form-control" type="text" name="address" id="address" value="{{ $corporate->address }}"></p>
		    <p><strong>Phone</strong>: <input class="form-control" type="text" name="phone" id="phone" value="{{ $corporate->phone }}"></p>
		    <p><strong>Description</strong>: <textarea class="form-control" name="descrip" id="descrip">{{ $corporate->descrip }}</textarea></p>

		    <p>
		    	
		    	<div class="col-md-12" style="padding:0">

		    	    <div class="col-md-12">
		    	    	<br><br>
		    	        <h4>Images</h4>
		    	        <hr>
		    	    </div>

		    	    <div class="col-md-6">
		    	    	<p><strong>Logo</strong></p>
	    	    	    <p>Upload a logo. <br>Suggested dimensions 64x64 pixels or 128x128 pixels</p>
	    	    	    <div class="dropzone" id="logodropzone"></div>
		    	    </div>

		    	    <div class="col-md-6">
		    	    	<p><strong>Banner</strong></p>
	    	    	    <p>Upload a banner. <br>Suggested dimensions 512x64 pixels or 1024x128 pixels</p>
	    	    	    <div class="dropzone" id="bannerdropzone"></div>
		    	    </div>

		    	</div>

		    </p>


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

		    <p>Change subscription plan</p>
		    <p><select class="form-control" name="subscription" id="subscription" style="width:30%">
		    	@if ($corporate->subscription_id == 1)
		    		<option value="basic" selected>Basic Plan</option>
		    	@else
		    		<option value="basic">Basic Plan</option>
		    	@endif
		    	@if ($corporate->subscription_id == 2)
		    		<option value="small" selected>Small Business Plan</option>
		    	@else 
		    		<option value="small">Small Business Plan</option>
		    	@endif
		    	@if ($corporate->subscription_id == 3)
		    		<option value="business" selected>Business Plan</option>
		    	@else
		    		<option value="business">Business Plan</option>
		    	@endif
		    	@if ($corporate->subscription_id == 4)
		    		<option value="premium" selected>Premium Plan</option>
		    	@else 
		    		<option value="premium">Premium Plan</option>
		    	@endif
		    </select></p>

		    <p><hr></p>
		    <p><button type="submit" class="btn btn-success">Save</button></p>

		</form>

	</div>

</div>

@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/msdropdown/jquery.dd.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>

<script>

	function setSub(currentSub) {
		$('#' + currentSub + '-current').html('CURRENT');
		$('#' + currentSub + '-panel-body').addClass('btn-info');
	}
	function removeSub(currentSub) {
		$('#' + subName + '-current').html('');
		$('#' + subName + '-panel-body').removeClass('btn-info');
	}

	$(document).ready(function(e) {

		var subName = '{{ $subscription->name }}';

		setSub(subName);

	    $('#subscription').change(function() {    
	        var item = $(this);
	        removeSub(subName);
	        setSub(item.val());
	        subName = item.val();
	    });

	    $("div#logodropzone").dropzone({ 
	    	init: function() {

	    		var mockFile;
	    		var fileuploded;

	    		@if ($corporate->logo_url != null || $corporate->logo_url != '')
	    		    mockFile = { name: "preview", size: 0, filename: "preview" };
	    		    this.emit("addedfile", mockFile);
	    		    this.createThumbnailFromUrl(mockFile, "{{ $corporate->logo_url }}");
	    		    this.emit("complete", mockFile);
	    		    fileuploded = mockFile.previewElement.querySelector("[data-dz-name]");
	    		    fileuploded.innerHTML = "preview";
	    		@endif

	    	},
	    	url: "{{ url('/corporate/' . $corporate->id . '/corpuser/administrator/uploadtemplogoimage') }}",
          	method: 'post',
          	headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
          	maxFilesize: 2, 
          	maxFiles: 1,
          	addRemoveLinks: true,
          	dictDefaultMessage: 'Click here to upload images or simply drop them here',
          	acceptedFiles: 'image/*',
          	success: function(file, response) {
            	$(file.previewTemplate).append('<span class="server_filename" style="display:none">'+response.filename+'</span>');
            	$(file.previewTemplate).append('<span class="server_fileurl" style="display:none">'+response.img_url+'</span>');
          	}
	    });

	    $("div#bannerdropzone").dropzone({ 
	    	init: function() {

	    		var mockFile;
	    		var fileuploded;

	    		@if ($corporate->banner_url != null || $corporate->banner_url != '')
	    		    mockFile = { name: "preview", size: 0, filename: "preview" };
	    		    this.emit("addedfile", mockFile);
	    		    this.createThumbnailFromUrl(mockFile, "{{ $corporate->banner_url }}");
	    		    this.emit("complete", mockFile);
	    		    fileuploded = mockFile.previewElement.querySelector("[data-dz-name]");
	    		    fileuploded.innerHTML = "preview";
	    		@endif

	    	},
	    	url: "{{ url('/corporate/' . $corporate->id . '/corpuser/administrator/uploadtempbannerimage') }}",
          	method: 'post',
          	headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
          	maxFilesize: 2, 
          	maxFiles: 1,
          	addRemoveLinks: true,
          	dictDefaultMessage: 'Click here to upload images or simply drop them here',
          	acceptedFiles: 'image/*',
          	success: function(file, response) {
            	$(file.previewTemplate).append('<span class="server_filename" style="display:none">'+response.filename+'</span>');
            	$(file.previewTemplate).append('<span class="server_fileurl" style="display:none">'+response.img_url+'</span>');
          	}
	    });

	});

</script>

@endsection