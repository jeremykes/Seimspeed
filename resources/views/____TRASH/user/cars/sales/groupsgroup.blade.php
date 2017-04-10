@extends('layouts.user')

@section('user-cars-active')
    active
@endsection

@section('user-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('user/cars/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars/sales/groups') }}">Groups</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars/sales/groups/group') }}">Group</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <h3>Mid year sales</h3>
          <hr>
          <p><strong>10 cars. Updated 3 days ago. Sale group added by SameSpeed.</strong></p>
        </div>

        <div class="col-md-4">
          <a href="{{ url('user/cars/sales/groups/group/car') }}">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="#">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="#">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="#">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="#">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="#">
            <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
              <div class="panel-body" style="padding:0;margin:0">
                <div class="col-md-12"><img class="img-responsive" src="/imgs/mycar.png"></div>
                <div class="col-md-12" style="padding:10px;">
                  <p><strong>Ford Ranger Red</strong></p>
                  <p>These short-cuts provide a very clean, ter...</p>
                  <p><span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/comment') }}">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/offer') }}">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="{{ url('user/cars/sales/car/tail') }}">243 tailing <i class="fa fa-eye"></i></span></a></p>
                </div> 
              </div>
            </div>
          </a>
        </div>
  
@endsection
