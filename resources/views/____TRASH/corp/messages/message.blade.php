@extends('layouts.corpmessages')

@section('corp-mess-inbo-active')
    active
@endsection

@section('corp-mess-inbo')
		    <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/messages') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/messages') }}">Messages</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/messages/inbox') }}">Inbox</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/messages/inbox/message') }}">Message</a>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
            <h4>Inbox</h4>
            <hr>
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
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                  <tr style="cursor:pointer">
                    <td>Jack Black</td>
                    <td>You may also get the full URL and append query para...</td>
                    <td><span class="label label-default">34</span></td>
                  </tr>
                </tbody>
              </tbody> 
            </table>
          </div>
          </div>
        </div>
@endsection
