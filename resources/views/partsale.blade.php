@extends('layouts.app')

@section('realtime')
    <script>

        /*
        |
        | 1. Bind all events here
        |
        */

        // publicChannel.bind('App\\Events\\UserReported', function(data) {
        //     UserReported(data);
        // });

        /*
        |
        | 2. All functions for the bound events
        |
        */

        // function UserReported(data) {
        //     alert("From: " + data.userreport.reporting_user_id + ". Report: " + data.userreport.report);
        // }


    </script>
@endsection

@section('content')
    <div class="container">

        <h2>Part Sale</h2>

    </div>
@endsection

@section('script')

    <!-- Some custom functions to go in here -->

@endsection
