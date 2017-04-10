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
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars/sales/car') }}">Car</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          Just a note that this is for NEGOTIABLE sales only.
        </div>

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
                            <li><a href="{{ url('/user/cars') }}"><i class="fa fa-btn fa-bank"></i> Unpublish</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> On hire</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Edit settings</a></li>
                        </ul>
                    </li>
                </ul>
                <p><strong>Ford Ranger Red</strong></p>
                <p>These short-cuts provided a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p><span style="color:gray;font-size:11px"><a href="#">7 comments <i class="fa fa-comment-o"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="#">23 offers <i class="fa fa-money"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px"><a href="#">243 tailing <i class="fa fa-eye"></i></span></a><span class="pull-right"><a href="#" class="label label-primary pull-right">view</a></span></p>
              </div> 
            </div>
          </div>
          <div class="list-group">
            <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
              <div class="col-md-12">
                <p>
                  <strong>Your offer</strong> 
                  <div class="input-group">
                    <span class="input-group-addon">K</span>
                    <input type="text" class="form-control" aria-label="Your offer">
                    <span class="input-group-addon">.00</span>
                  </div>
                  <div class="input-group">
                    <br>
                    <a class="btn btn-success btn-xs">Offer</a>
                  </div>
                </p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p style="font-size:18px"><span class="label label-default">K8,450.00</span></p>
                <p class="pull-right"><a style="font-size:9px" class="btn btn-xs btn-success">accept offer</a> <a style="font-size:9px" class="btn btn-xs btn-default">delete offer</a> <a style="font-size:9px" class="btn btn-xs btn-danger">report user</a></p>
              </div>
            </div>
          </div>
        </div>
        
@endsection
