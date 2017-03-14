@extends('layouts.user')

@section('user-home-active')
    active
@endsection

@section('user-home')
        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
            Views contain the HTML served by your application and separate your controller / application logic from your presentation logic.
          </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="panel panel-primary">
          <div class="panel-body">
            In this case, we are passing the name variable, which is displayed in the view by executing echo on the variable.
          </div>
          </div>
        </div>
@endsection
