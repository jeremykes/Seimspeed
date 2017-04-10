@extends('layouts.usermessages')

@section('user-mess-inbo-active')
    active
@endsection

@section('user-mess-inbo')
		    <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('user/messages') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/messages') }}">Messages</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('user/messages/inbox') }}">Inbox</a>
        </div>

        <br>
        <hr>

        <div class="col-md-12" style="padding:0">
            <div class="col-md-4" style="padding:0">
                <div class="panel panel-primary">
                <div class="panel-body">
                  <h4>Inbox</h4>
                  <hr>
                  <div class="col-md-12" style="padding:0">
                    <table class="table table-bordered table-hover"> 
                      <tbody> 
                        <thead>
                          <tr>
                            <th>From</th>
                            <th>Message</th>
                            <th>Replies</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="info" style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                          <tr style="cursor:pointer">
                            <td>Jack Black</td>
                            <td>You may also get...</td>
                            <td><span class="label label-default">34</span></td>
                          </tr>
                        </tbody>
                      </tbody> 
                    </table> 
                  </div>
                </div>
              </div> 
            </div>
            <div class="col-md-8" style="padding-left:5px;padding-right:0">
              <div class="panel panel-primary">
              <div class="panel-body">
                <h4>Jack Black</h4>
                <hr>

                <div class="col-md-8" style="margin-bottom:5px">
                  <div class="col-md-3">
                    <img class="img-responsive" src="/imgs/mycar.png">
                  </div>
                  <div class="col-md-9">
                    <div class="bubbleyou">
                      You may also get the full URL and append query parameters.
                    </div>
                  </div>
                </div>

                <div class="col-md-offset-4 col-md-8" style="margin-bottom:5px">
                  <div class="col-md-9">
                    <div class="bubbleme">
                      You may also get the full URL and append query parameters. 
                    </div>
                  </div>
                  <div class="col-md-3">
                    <img class="img-responsive" src="/imgs/mycar.png">
                  </div>
                </div>

                <div class="col-md-8" style="margin-bottom:5px">
                  <div class="col-md-3">
                    <img class="img-responsive" src="/imgs/mycar.png">
                  </div>
                  <div class="col-md-9">
                    <div class="bubbleyou">
                      You may also get the full URL and append query parameters.
                    </div>
                  </div>
                </div>

              </div>
              </div>
            </div>
        </div>
@endsection
