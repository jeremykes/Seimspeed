@extends('layouts.corp')

@section('corp-sett-active')
    active
@endsection

@section('corp-sett')
		<div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/account') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/settings') }}">Settings</a>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
                <ul class="nav navbar-nav navbar-right" style="padding-right:20px">
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

            <h4>Settings</h4>
            <hr>
            <div class="col-md-12">
              <table class="table table-bordered"> 
                <tbody> 
                  <tr> 
                    <td>Corporate Name</td> 
                    <td>SameSpeed</td>
                  </tr> 
                  <tr> 
                    <td>Address</td> 
                    <td>P.O. Box 123</td>
                  </tr> 
                  <tr> 
                    <td>Phone</td> 
                    <td>73645928</td>
                  </tr> 
                </tbody> 
              </table>
            </div>
          </div>
          </div>
        </div>
@endsection
