@extends('layouts.user')

@section('menu')

<ul class="list-group">
    <a href="{{ url('/user') }}" class="list-group-item">Messages</a>
    <a href="{{ url('/user/settings') }}" class="list-group-item">Settings</a>
</ul> 

@endsection

@section('content')

<div class="col-md-12">
    <h2>Create Corporate Account - Pending</h2>
    <hr>
</div>

<div class="col-md-12">

    <h3>Your subscription is pending...</h3>
    <hr>
    <p>Thank you so much for your subscription! We will contact you shortly to complete the setup process.</p>

</div>

@endsection


