@extends('layouts.user')

@section('user-part-active')
    active
@endsection

@section('user-part')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('user/partsaccessories/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/parts') }}">Parts</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/partsaccessories/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/partsaccessories/sales/groups') }}">Groups</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/partsaccessories/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/partsaccessories/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('user/partsaccessories/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
          This panel show you all responses from customers or potential buys. You are required to respond to these.
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Groups <img src="/imgs/traffic_jam.png" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body" style="padding:0;margin:0">
            <table class="table table-bordered table-striped" style="margin-bottom:0"> 
              <tbody> 
                <tr> 
                  <td><img class="img-responsive" src="/imgs/mycar.png"></td>
                  <td>
                    <p><strong>Mid year sales</strong> <span class="label label-danger">group</span><span class="pull-right"><span class="label label-default">10 cars</span></span></p>
                    <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                    <p><span style="color:gray;font-size:11px">7 comments <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">23 offers <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">243 tailing <i class="fa fa-eye"></i></span></p>
                  </td> 
                  <td style="font-size:11px;color:grey">2 minutes ago</td> 
                  <td style="font-size:15px;"><a href="#" class="label label-primary">view</a></td>
                </tr> 
                <tr> 
                  <td><img class="img-responsive" src="/imgs/mycar.png"></td>
                  <td>
                    <p><strong>Mid year sales</strong> <span class="label label-danger">group</span><span class="pull-right"><span class="label label-default">10 cars</span></span></p>
                    <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                    <p><span style="color:gray;font-size:11px">7 comments <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">23 offers <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">243 tailing <i class="fa fa-eye"></i></span></p>
                  </td> 
                  <td style="font-size:11px;color:grey">2 minutes ago</td> 
                  <td style="font-size:15px;"><a href="#" class="label label-primary">view</a></td>
                </tr>
                <tr> 
                  <td><img class="img-responsive" src="/imgs/mycar.png"></td>
                  <td>
                    <p><strong>Mid year sales</strong> <span class="label label-danger">group</span><span class="pull-right"><span class="label label-default">10 cars</span></span></p>
                    <p>These short-cuts provide a very clean, terse way of working with PHP control structures, while also remaining familiar to their PHP counterparts.</p>
                    <p><span style="color:gray;font-size:11px">7 comments <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">23 offers <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">243 tailing <i class="fa fa-eye"></i></span></p>
                  </td> 
                  <td style="font-size:11px;color:grey">2 minutes ago</td> 
                  <td style="font-size:15px;"><a href="#" class="label label-primary">view</a></td>
                </tr>
              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
