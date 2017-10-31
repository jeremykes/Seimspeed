@extends('layouts.user')

@section('menu')

<ul class="list-group">
    <a href="{{ url('/user') }}" class="list-group-item">Messages</a>
    <a href="{{ url('/user/settings') }}" class="list-group-item">Settings</a>
</ul> 

@endsection

@section('content')

<div class="col-md-12">
    <h2>Create Corporate Account</h2>
    <hr>
</div>

<div class="col-md-12">

    <form action="{{ url('/auth/addcorporate') }}" method="post" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

        @include('common.errors')

        <p><strong>Name</strong>: <input name="name" type="text" class="form-control" placeholder="Name"/></p>
        <p><strong>Address</strong>: <input name="address" type="text" class="form-control" placeholder="Address"/></p>
        <p><strong>Phone</strong>: <input name="phone" type="text" class="form-control" placeholder="Phone"/></p>
        <p><strong>Description</strong>: <input name="descrip" type="text" class="form-control" placeholder="Description"/></p>

        <p>
            <strong>Upload new logo</strong>:<br><br> 
            <input type="file" name="logo_url">
        </p>

        <p>
            <strong>Upload banner image</strong>:<br><br> 
            <input type="file" name="banner_url">
        </p>

        <p>

            <div class="col-md-12" style="padding:0">

                <div class="col-md-12">
                    <hr>
                    <h3>Select Your Subscription Plan</h3>
                </div>

                <div class="col-md-12">
                    These subscription plans show you how many cars and parts you are able to sell, rent, auction or tender.
                    <br>    
                    <br>
                </div>

                <div class="col-md-3" style="padding:1px">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Basic Plan
                        </div>
                        <div class="panel-body" style="text-align:center;">
                            <p>5 cars</p>
                            <p>10 parts</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <hr>
                            <h4>Free</h4>
                            <p><a href="javascript:void(0);" class="btn btn-primary" id="btn-basic-plan" onclick="selectPlan('basic')">selected</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" style="padding:1px">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Small Business Plan
                        </div>
                        <div class="panel-body" style="text-align:center">
                            <p>20 cars</p>
                            <p>100 parts</p>
                            <p>Reports</p>
                            <p>&nbsp;</p>
                            <hr>
                            <h4>K300 <span style="font-size:10px;color:gray">/month</span></h4>
                            <p><a href="javascript:void(0);" class="btn btn-default" id="btn-small-plan" onclick="selectPlan('small')">choose</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" style="padding:1px">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Business Plan
                        </div>
                        <div class="panel-body" style="text-align:center">
                            <p>30 cars</p>
                            <p>200 parts</p>
                            <p>Detailed Reports</p>
                            <p>Monthly Statistics</p>
                            <hr>
                            <h4>K1,000 <span style="font-size:10px;color:gray">/month</span></h4>
                            <p><a href="javascript:void(0);" class="btn btn-default" id="btn-business-plan" onclick="selectPlan('business')">choose</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" style="padding:1px">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Premium Plan
                        </div>
                        <div class="panel-body" style="text-align:center">
                            <p>Unlimited cars</p>
                            <p>Unlimited parts</p>
                            <p>Detailed Reports</p>
                            <p>Monthly Statistics</p>
                            <hr>
                            <h4>K3,000 <span style="font-size:10px;color:gray">/month</span></h4>
                            <p><a href="javascript:void(0);" class="btn btn-default" id="btn-premium-plan" onclick="selectPlan('premium')">choose</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </p>

        <hr>

        <input name="subscription" id="subscription" type="hidden" value="basic"/>  

        <div class="col-md-12">
            <br>
            <br>
        </div>

        <p><button class="btn btn-success btn-sm" type="submit">Create Corporate</button></p>

    </form>

    <div class="col-md-12">
        <br>
        <br>
        <br>
    </div>

</div>

@endsection


