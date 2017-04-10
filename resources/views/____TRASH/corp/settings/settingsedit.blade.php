@extends('layouts.corp')

@section('corp-sett-active')
    active
@endsection

@section('corp-sett')
		    <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/account') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/settings') }}">Settings</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/settings/edit') }}">Edit</a>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
            <h4>Settings</h4>
            <hr>
            <div class="col-md-12">
                    <form>
                      <div class="form-group col-md-6">
                        <label for="plates">Plates</label>
                        <input type="text" class="form-control" id="plates" placeholder="Plates">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" id="color" placeholder="Color">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" placeholder="Weight">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="datebought">Date bought</label>
                        <input type="text" class="form-control" id="datebought" placeholder="Date bought">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="make">Make</label>
                        <input type="text" class="form-control" id="make" placeholder="Make">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" placeholder="Model">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="bodytype">Body type</label>
                        <input type="text" class="form-control" id="bodytype" placeholder="Body type">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" placeholder="Note">
                      </div>
                      <div class="checkbox col-md-12">
                        <label>
                          <input type="checkbox"> Don't Publish Now
                        </label>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-default pull-right">Save</button>
                      </div>
                    </form>
                </div>
          </div>
          </div>
        </div>
@endsection
