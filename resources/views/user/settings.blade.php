@extends('layouts.user')

@section('menu')

<ul class="list-group">
    <a href="{{ url('/user') }}" class="list-group-item">Messages</a>
    <a href="{{ url('/user/settings') }}" class="list-group-item active">Settings</a>
</ul> 

@endsection

@section('content')

<div class="col-md-12">
    <h2>Settings <a href="{{ url('/user/settings/edit') }}" class="btn btn-xs btn-default pull-right">Edit</a></h2>
    <hr>
</div>

<div class="col-md-12">

    <p><strong>Display name</strong>: {{ $user->name }}</p>
    <p><strong>Email</strong>: {{ $user->email }}</p>
    <p><strong>Password</strong>: ********* </p>

    <p>
        <strong>Receive email notificaitons</strong>: 

        @if ($settings->receive_email_notifications == 1) 
            Yes
        @else
            No
        @endif

    </p>
    <br>
    <h4>Corporate member of</h4>
    
    <hr>

    @if ($corporateusers->count() > 0)
        @foreach ($corporateusers as $corporateuser)

            <p><strong><a href="{{ url('/corporate/' . $corporateuser->corporate->id . '/dashboard') }}">{{ $corporateuser->corporate->name }}</a></strong>, as {{ $corporateuser->title }}</p>

        @endforeach
    @else
        <p><strong>Nothing</strong></p>
    @endif

    <br>
    <h4>Linked Social Accounts</h4>
    
    <hr>

    @if ($socialprofiles->count() > 0)
        @foreach ($socialprofiles as $socialprofile)

            <p><strong>{{ $socialprofile->provider }}</strong></p>

        @endforeach
    @else
        <p><strong>None</strong></p>
    @endif

</div>

@endsection
