@extends('layouts.user')

@section('menu')

<ul class="list-group">
    <a href="{{ url('/user') }}" class="list-group-item active">Messages</a>
    <a href="{{ url('/user/settings') }}" class="list-group-item">Settings</a>
</ul> 

@endsection

@section('content')

<div class="col-md-12">
    <h2>Messages</h2>
    <hr>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="padding-left:3px;padding-right:3px;">
        <div class="panel panel-default" style="height:500px;min-height:500px;overflow:scroll">
            <p style="padding-top:9px;padding-left:9px"><strong>People</strong></p>
            <ul class="list-group">

                @foreach ($messages as $message)

                    <li class="list-group-item">
                        <a href="javascript:void(0)" onclick="getUserMessages({{ $message->sendinguser->id }})">
                            <img src="{{ $message->sendinguser->propic }}" style="width:20px;height:20px"> {{ $message->sendinguser->name }}
                        </a>
                    </li>
                    
                @endforeach

            </ul> 

        </div>
    </div>

    <div class="col-md-8" style="padding-left:3px;padding-right:3px;">
        <div class="panel panel-default" style="height:500px;">
            <p style="padding-top:9px;padding-left:9px"><strong>Conversation</strong></p>
            <hr style="padding:0;margin:0">
            <div class="col-md-12" id="usermessages" style="height:450px;min-height:450px;overflow:scroll;padding-bottom:100px;">
                
            </div>
            <div class="col-md-12" id="message_input" style="display:none">
                <div class="bottom_wrapper">
                    <div class="message_input_wrapper">
                        <input class="message_input" placeholder="Type..." />
                    </div>
                    <div class="send_message" onclick="sendMessage()">
                        <div class="icon"></div>
                        <div class="text">Send</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
