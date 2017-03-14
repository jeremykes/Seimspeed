@extends('layouts.corp')

@section('corp-acco-active')
    active
@endsection

@section('corp-acco')
		    <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/account') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/account') }}">Account</a>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
            <h4>Your Account</h4>
            <hr>
            <p>You are subscribed to the <span class="label label-info" style="font-size:15px">Executive Plan</span> To upgrade your account, please click <a class="btn btn-success btn-md">Upgrade</a></p>
            <hr>
            <table class="table table-bordered"> 
              <tbody> 
                <tr> 
                  <td>Total Cars</td> 
                  <td><span class="label label-primary" style="font-size:15px">14</span><span style="font-size:20px"><strong> / 20</strong></span></td>
                </tr> 
                <tr> 
                  <td>Parts</td> 
                  <td><span class="label label-primary" style="font-size:15px">5</span><span style="font-size:20px"><strong> / Unlimited</strong></span></td>
                </tr> 
                <tr> 
                  <td><hr><h3>Bonus</h3></td> 
                  <td><hr></td>
                </tr> 
                <tr> 
                  <td>Reports</td> 
                  <td></td>
                </tr> 
                <tr> 
                  <td>Customer Support</td> 
                  <td></td>
                </tr> 
                <tr> 
                  <td>Inteligent Suggestions</td> 
                  <td></td>
                </tr> 
              </tbody> 
            </table>
          </div>
          </div>
        </div>
@endsection
