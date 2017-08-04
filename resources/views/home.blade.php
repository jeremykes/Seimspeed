@extends('layouts.home')

@section('content')

    <div class="col-md-12" id="newsfeed">
        
    </div>

    <div class="col-md-12" id="loading" style="text-align:center;font-size:23px;"></div>

@endsection

@section('script')

    <script>
    
        /*
        |
        | Execute initial scripts when document is ready
        |
        */
        $(document).ready(function(e) {

            // Moment.js script to update all timestamps on the page
            updateTimestamps();
            window.setInterval(function(){
                updateTimestamps();
            }, 60000);

            // Initially load the newsfeed with trades
            getNewsFeed(nextPageURL);

            // Autoscroll contents with getnewsfeed pagination
            
            $(window).scroll(function() {
                // End of the document reached?
                if ($(document).height() - $(window).height() == $(window).scrollTop()) {
                    getNewsFeed(nextPageURL);
                }
            });

        });

    </script>

@endsection
