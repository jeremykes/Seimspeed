@extends('layouts.user')

@section('menu')

<ul class="list-group">
    <a href="{{ url('/user') }}" class="list-group-item">Messages</a>
    <a href="{{ url('/user/settings') }}" class="list-group-item active">Settings</a>
</ul> 

@endsection

@section('content')

<div class="col-md-12">
    <h2>Settings</h2>
    <hr>
</div>

<div class="col-md-12">

    <form action="{{ url('/user/settings/edit/save') }}" method="post" enctype="multipart/form-data">
        
        {!! csrf_field() !!}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops! Something went wrong!</strong>

                <br><br>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p><strong>Display name</strong>: <input name="name" type="text" class="form-control" value="{{ $user->name }}"/></p>
        <p><strong>Email</strong>: <input name="email" type="text" class="form-control" value="{{ $user->email }}"/></p>
        <p><strong>Password</strong>: <a href="#">Reset Password</a></p>

        <p>
            <strong>Receive email notificaitons</strong>: 

            <select name="receive_email_notifications">
                
                @if ($settings->receive_email_notifications == 1) 
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                @else
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                @endif

            </select>

        </p>

        <p>

            <strong>Upload new profile picture</strong> <span style="font-size:10px;color:gray">(this will delete your existing picture)</span>:<br><br> 

            <input type="file" name="propic">
        </p>

        <hr>

        <p><button class="btn btn-success btn-sm" type="submit">Save</button></p>

    </form>

</div>

@endsection
