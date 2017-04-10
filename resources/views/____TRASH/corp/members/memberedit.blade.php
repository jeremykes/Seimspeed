@extends('layouts.corp')

@section('corp-memb-active')
    active
@endsection

@section('corp-memb')
        
        <!-- Modals START -->
        <div class="modal fade" id="memberblock" tabindex="-1" role="dialog" aria-labelledby="memberblocklabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="memberblocklabel">Block member</h4>
              </div>
              <div class="modal-body col-md-12">
                <p>Are you sure you want to block this member?</p>
                <p>You can unblock the member again in blocked members</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Block</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="memberdelete" tabindex="-1" role="dialog" aria-labelledby="memberdeletelabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="memberdeletelabel">Delete member</h4>
              </div>
              <div class="modal-body col-md-12">
                <p>Are you sure you want to delete this member?</p>
                <p>You can undelete the member again in deleteed users</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">delete</button>
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
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/members/member') }}">Member</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/members/member/edit') }}">Edit</a>
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

              <div class="col-md-12">
                    <form>
                      <div class="form-group">
                        <label for="plates">User</label>
                        <input type="text" class="form-control" id="plates" placeholder="Plates">
                      </div>
                      <div class="form-group">
                        <label for="color">Title</label>
                        <input type="text" class="form-control" id="color" placeholder="Color">
                      </div>
                      <div class="form-group">
                        <label for="weight">Role</label>
                        <input type="text" class="form-control" id="weight" placeholder="Weight">
                      </div>
                      <div>
                        <button type="submit" class="btn btn-default pull-right">Save</button>
                      </div>
                    </form>
                </div> 
            </div>
          </div>
        </div>
        
@endsection
