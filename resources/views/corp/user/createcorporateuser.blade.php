@extends('corp.layouts.app')


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

  <div class="col-md-12"><h4>Add new member</h4></div>

  <div class="col-md-12"><hr style="padding:5px;margin:0"></div>

  <div class="col-md-12">
      <form action="{{ url('/corporate/' . $corporate->id . '/corpuser/maintainer/addcorporateuser') }}" method="post">

          @include('common.errors')

          <!-- To send carID into controller if user selects one. FUTURE -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
              <span style="color:grey;font-size:10px">Email of the user to be added as a member to this account.</span>
          </div>
          <div class="form-group col-md-6">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title of new member">
              <span style="color:grey;font-size:10px">Title of new member</span>
          </div>
          <div class="col-md-12"><strong>Member Roles</strong></div>
          <div class="col-md-12"><p>Please select either one or multiple roles for the new member.</p></div>
          <div class="form-group col-md-12">
              <label class="form-check-label">
                <input type="checkbox" name="role_manager" id="role_manager" class="form-check-input">
                Manager <span class="label label-danger">view reports</span>
              </label>
          </div>
          <div class="form-group col-md-12">
              <label class="form-check-label">
                <input type="checkbox" name="role_maintainer" id="role_maintainer" class="form-check-input">
                Maintainer <span class="label label-danger">create cars/parts</span> <span class="label label-danger">add/edit members</span>
              </label>
          </div>
          <div class="form-group col-md-12">
              <label class="form-check-label">
                <input type="checkbox" name="role_sales" id="role_sales" class="form-check-input">
                Sales <span class="label label-danger">create sales/rents/tenders/auctions</span> <span class="label label-danger">accept/cancel offers, tenders, bids</span> <span class="label label-danger">close sales, rents, tenders, auctions</span>
              </label>
          </div>
          <div class="form-group col-md-12">
              <label class="form-check-label">
                <input type="checkbox" name="role_administrator" id="role_administrator" class="form-check-input">
                Administrator <span class="label label-danger">can do everything. Superuser.</span>
              </label>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-default pull-right" id="savebutton">Save</button>
        </div>
      </form>
  </div>  

</div>

@endsection
