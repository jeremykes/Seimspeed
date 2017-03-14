@extends('layouts.corp')

@section('corp-memb-active')
    active
@endsection

@section('corp-memb')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/members') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/members') }}">Members</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="#">Add new member</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">Assign roles</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">delete members</a>
            </span>
        </div>

        <br>
          
        <hr>

        <div class="col-md-12" style="margin-bottom:10px">
        </div>

        <div class="col-md-8 col-md-offset-2">
          <h4>Summary</h4>
          <hr>
          <table class="table table-bordered"> 
            <tbody> 
              <tr> 
                <td>Total members</td> 
                <td style="font-size:15px;"><span class="label label-primary">14</span></td>
              </tr> 
              <tr> 
                <td>External members</td> 
                <td style="font-size:15px;"><span class="label label-primary">5</span></td>
              </tr> 
              <tr> 
                <td>Roles utilized</td> 
                <td style="font-size:15px;"><span class="label label-primary">8</span></td>
              </tr> 
              <tr> 
                <td>Disabled members</td> 
                <td style="font-size:15px;"><span class="label label-primary">1</span></td>
              </tr> 
              <tr> 
                <td>Deleted members</td> 
                <td style="font-size:15px;"><span class="label label-primary">0</span></td>
              </tr> 
              <tr> 
                <td>Super Administrators</td> 
                <td style="font-size:15px;"><span class="label label-primary">3</span></td>
              </tr> 
            </tbody> 
          </table>
        </div>

        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-heading dropdown">
            Members <img src="/imgs/land_sales.png" style="height:40px;width:auto"> 
          </div>
          <div class="panel-body">
            <table class="table table-bordered table-hover"> 
              <tbody> 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>2 days ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jane Doe</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Sales - Cars</span> <span class="label label-primary">Site Updater</span></td>
                    <td>1 day ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>a few hours ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>2 weeks ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>a month ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>a year ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>just now</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td><span class="label label-primary">Administrator</span></td>
                    <td>2 days ago</td>
                    <td><i class="fa fa-edit"></i></td>
                  </tr>
                </tbody>
              </tbody> 
            </table>
          </div>
          </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Roles <img src="/imgs/car_rental.png" style="height:40px;width:auto"> 
            </div>
            <div class="panel-body" style="padding:0;margin:0">
              <table class="table table-bordered"> 
                <tbody> 
                  <tr> 
                    <td><span class="label label-primary">Super Administrator</span></td> 
                    <td>able to do everything.</td>
                  </tr> 
                  <tr> 
                    <td><span class="label label-primary">Message Handler</span></td> 
                    <td>handles all messages that arrive.</td>
                  </tr> 
                  <tr> 
                    <td><span class="label label-primary">Site Updater</span></td> 
                    <td>update the site content.</td>
                  </tr>
                  <tr> 
                    <td><span class="label label-primary">Member</span></td> 
                    <td>limited access member.</td>
                  </tr> 
                  <tr> 
                    <td><span class="label label-primary">Sales - Cars</span></td> 
                    <td>handles all upload and sales of cars.  </td>
                  </tr> 
                  <tr> 
                    <td><span class="label label-primary">Sales - Parts &amp; Accessories</span></td> 
                    <td>handles all upload and sales of parts and accessories.  </td>
                  </tr> 
                </tbody> 
              </table>
            </div>
          </div>
        </div>

@endsection
