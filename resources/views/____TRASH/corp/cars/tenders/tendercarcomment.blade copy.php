@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/tenders') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/tenders') }}">Tenders</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/tenders/car') }}">Car</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders') }}">Tenders</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/tenders/reserves') }}">Reserved</a>
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
              </div> 
            </div>
          </div>
          <div class="list-group" style="padding-top:0;margin-top:0">
            <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
              <div class="col-md-12">
                    <input type="text" class="form-control" aria-label="Your comment" style="margin-bottom:5px">
                    <a class="btn btn-default btn-xs">Comment</a>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
            <div class="list-group-item col-md-12">
              <div class="col-md-2">
                <img class="img-responsive" src="/imgs/mycar.png"> 
              </div>
              <div class="col-md-10">
                <p><strong>Aya Stark</strong> <span class="pull-right"><span style="color:gray;font-size:11px">2 minutes ago</span></span></p>
                <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                <p class="pull-right"><a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="#">reply</a></p>
              </div>
            </div>
          </div>
        </div>
        
@endsection
