@extends('layouts.app')

@section('realtime')
<script>

    /*
    |
    | 1. Bind all events here
    |
    */

    publicChannel.bind('App\\Events\\UserReported', function(data) {
        UserReported(data);
    });
    publicChannel.bind('App\\Events\\CarAdded', function(data) {
        CarAdded(data);
    });

    /*
    |
    | 2. All functions for the bound events
    |
    */
    function UserReported(data) {
        alert("From: " + data.userreport.reporting_user_id + ". Report: " + data.userreport.report);
    }

    function CarAdded(data) {
        alert(data);
    }


    // OLD CODE ========== 

    // // PRIVATE BINDINGS
    // userReportedChannel.bind('App\\Events\\UserReported', function(data) {
    //     // Do something here. Example:
    //     alert("From: " + data.userreport.reporting_user_id + ". Report: " + data.userreport.report);
    // });

    // // PUBLIC BINDINGS
    // carAddedChannel.bind('App\\Events\\CarAdded', function(data) {
    //     // Do something here. Example:
    //     alert(data);
    // });

</script>

@endsection

@section('content')
<div class="container">

    <div id="newsfeed" class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- EVERYTHING WILL BE APPENDED, PREPENDED -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br><br>

                    <input type="text" name="message" id="message">
                    <input type="text" name="user_id_receiving" id="user_id_receiving">
                    <button onclick="sendmessage()">Send</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function sendmessage() {
        $.ajax({
            type: "POST",
            url: "{{ url('/sendmessage') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              message: $('#message').val(),
              user_id_receiving: $('#user_id_receiving').val()
            }
        }).done(function(data) {
            // Do something
            // alert(data.success);
        });
    }
</script>
@endsection
