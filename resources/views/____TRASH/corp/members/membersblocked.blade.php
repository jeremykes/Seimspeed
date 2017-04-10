@extends('layouts.corp')

@section('corp-memb-active')
    active
@endsection

@section('corp-memb')
        
        <!-- Modals START -->
        <div class="modal fade" id="memberunblock" tabindex="-1" role="dialog" aria-labelledby="memberunblocklabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="memberunblocklabel">Unblock member</h4>
              </div>
              <div class="modal-body col-md-12">
                <p>Are you sure you want to unblock this member?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Unblock</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modals END -->

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/members') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/members') }}">Members</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/members/blocked') }}">Blocked</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="#">Add new member</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">Assign roles</a>
              <a style="font-size:10px" class="btn btn-warning btn-xs" href="#">delete members</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <div class="panel-body">
            <h3>Blocked Members</h3>
            <hr>
            <table class="table table-bordered table-hover"> 
              <tbody> 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Role</th>
                    <th></tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td>Jack Black</td>
                    <td>SameSpeed Director</td>
                    <td>Administrator</td>
                    <td><a href="#" data-toggle="modal" data-target="#memberunblock">unblock</a></td>
                  </tr>
                </tbody>
              </tbody> 
            </table>
          </div>
          </div>
        </div>
        
@endsection
