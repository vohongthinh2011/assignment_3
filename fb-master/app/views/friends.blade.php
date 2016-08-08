@extends('layouts.master')

@section('title')
    <title>FB | Friends</title>
@stop 

@section('style')
    <link rel="stylesheet" type="text/css" href="/css/friends.css">
@stop 

@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" "href="/friends">My Friends List</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$user->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row-fluid">
        <div class="col-md-4">
            <div class="profile">
                <img src="{{$user->profile_pic}}">
                <h1>{{$user->name}}</h1>
                <p>{{$user->gender}}</p>
                <p><a href="/feed">Back to Feed</a></p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="post-form"> <!-- remember to create new css class, not use class from post.css -->
                <h4>Search For Friends</h4>
                {{Form::open(['action' => 'FriendsController@addFriend', 'method' => 'POST', 'class' => "form"])}}
                    <div class="form-group">
                        <input name="email" type="email" placeholder="Type Friend's Email" class="form" required>
                        {{Form::submit('Send Request', ['class' => 'btn btn-primary'])}}
                    </div>                
                {{Form::close()}}
            </div>
            <div class="posts"><!-- replace posts class with friends class on css -->
                @foreach($friends as $friend)
                    <div class="post"><!--replace-->
                        <p>{{$friend->full_name}} {{$friend->email}} (friends since) {{$friend->created_at}}</p>
                    </div>
                @endforeach
            
        </div>
    </div>
</div>

@stop  
