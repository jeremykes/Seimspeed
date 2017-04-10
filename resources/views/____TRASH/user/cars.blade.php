@extends('layouts.user')

@section('user-cars-active')
    active
@endsection

@section('user-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('user/cars/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/cars') }}">Cars</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="#">Add new car</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">unpublished cars</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">deleted cars</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">deleted groups</a>
            </span>
        </div>

        <br>
          
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
          This panel show you all responses from customers or potential buys. You are required to respond to these.
        </div>

        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">
              Outstanding Actions <span class="badge">12</span>
            </div>
            <div class="panel-body">
              <table class="table table-hover" style="margin-bottom:0"> 
                <tbody> 
                  <tr> 
                    <td>Bruce Willis</td> 
                    <td>Submitted a tender</td> 
                    <td style="font-size:11px;color:grey">2 minutes ago</td> 
                    <td style="font-size:15px;"><span class="label label-primary">view</span></td>
                  </tr> 
                  <tr> 
                    <td>Jane Foster</td> 
                    <td>Reserved a car</td> 
                    <td style="font-size:11px;color:grey">an hour ago</td> 
                    <td style="font-size:15px;"><span class="label label-primary">view</span></td>
                  </tr> 
                  <tr> 
                    <td><a href="#">See all...</a></td> 
                    <td></td> 
                    <td style="font-size:11px;color:grey"></td> 
                    <td style="font-size:15px;"></td>
                  </tr> 
                </tbody> 
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-12" style="margin-bottom:10px">
          <hr>
          These panels show you all car tradings. They show you all cars and the groups they are in.
        </div>

        <div class="col-md-6">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Sales <img src="/imgs/land_sales.png" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <div class="list-group" style="margin-bottom:0">
              <a href="{{ url('/user/cars/sales') }}" class="list-group-item" style="border-radius:0">Cars on sale <span class="label label-primary pull-right">10</span></a>
              <a href="#" class="list-group-item" style="border-radius:0">Cars currently reserved <span class="label label-primary pull-right">34</span></a>
            </div> 
            <h4 style="padding:10px;">Sale Groups</h4>
            <table class="table table-bordered table-hover" style="margin-bottom:0"> 
              <tbody> 
                <tr> 
                  <td>Mid year sale</td> 
                  <td style="font-size:11px;color:grey">2 minutes ago</td> 
                  <td style="font-size:15px;"><span class="label label-primary">view</span></td>
                </tr> 
                <tr> 
                  <td>Going finish sale</td> 
                  <td style="font-size:11px;color:grey">an hour ago</td> 
                  <td style="font-size:15px;"><span class="label label-primary">view</span></td>
                </tr> 
                <tr> 
                  <td><a href="#">See all groups</a></td> 
                  <td style="font-size:11px;color:grey"></td> 
                  <td style="font-size:15px;"></td>
                </tr> 
              </tbody> 
            </table>
          </div>
          </div>
        </div>

@endsection
