@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('corp-part')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts') }}">Parts</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales/partaccessory') }}">Part &amp; Accessory</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/partsaccessories/sales/partaccessory/edit') }}">Edit Settings</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/partsaccessories/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <div class="panel-body">
              <div class="col-md-3"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-9">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Options <span class="caret"></span>
                            </span>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i> Sold</a></li>
                                <li><a href="{{ url('/corporate/cars') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                            </ul>
                        </li>
                    </ul>
                    <p><strong>Ford Ranger Red</strong></p>
                    <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                    <p><span style="color:gray;font-size:11px"><a href="{{ url('corporate/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('corporate/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('corporate/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a><span class="pull-right"><a href="#" class="label label-primary pull-right">view</a></span></p>
                </div> 

                <div class="col-md-12">
                    <hr>
                </div>

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

                <div class="col-md-12">
                    <p>Some more settings down here</p>
                </div>
            </div>
          </div>
        </div>
        
@endsection
