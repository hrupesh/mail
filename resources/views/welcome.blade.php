@extends('master')
@section('title')
HelloJNU
@endsection
@section('content')
<script> 
    $(document).ready(function(){
        $(".btn-primary").click(function(){
            $("#reg").fadeIn();
            $(".active").animate({
                left: '250px',
                height: '650px',
                width: '650px'
            });
        });
       $(".btn-success").click(function(){
            $("#login").fadeIn();
            $(".passive").animate({
                left: '250px',
                height: '450px',
                width: '650px'
            });
        });
    });
    </script>
<div class="container">
    <div class="well row"> 
            <button class="col btn btn-primary" style="padding-right:500px"><b>Register</b></button>
            <button class="col btn btn-success" style="padding-left:500px"><b>Login</b></button>
    </div>
</div>  
@include('includes.message')
<div class="container jumbotron">
    <div class="col-md-5 well active" id="reg" style="display:none;">
        <h3>Sign Up</h3>
        <form action="{{ route('signUp') }}" method="post">
            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="Email">Your Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{{ Request::old('email')}}">
            </div> 
            <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
                <label for="Name">First Name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name" value="{{Request::old('first_name')}}">
            </div>
            <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                <label for="Name">Last Name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{Request::old('last_name')}}">
            </div>
            <div class="form-group {{$errors->has('Contact_No') ? 'has-error' : ''}}">
                <label for="Name">Contact Number</label>
                <input class="form-control" type="integer" name="Contact_No" id="Contact_No" placeholder="Contact No" value="{{Request::old('Contact_No')}}">
            </div>
            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                <label for="Password">Your Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="{{Request::old('password')}}">
            </div>
            <div class="column">
            <button type="submit" class="col-md-12 btn btn-primary btn-lg">Sign Up</button>   
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
        </form>
    </div>
<div class="row"> 
    <div class="col-md-1 well passive" id="login" style="display:none;">
        <h3>Sign IN</h3>
        <form action="{{ route('signIn') }}" method="post">
            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="Email">Your Email</label>
                <input class="form-control" type="text" name="email" id="email" value="{{Request::old('email')}}">
            </div> 
            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                <label for="Password">Your Password</label>
                <input class="form-control" type="password" name="password" id="password" value="{{Request::old('password')}}">
            </div>
            <div style="margin-top: 90px;">
            <button type="submit" class="col-md-12 btn btn-danger btn-lg">Sign In</button>   
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
        </form>
    </div>
</div>
</div>


@endsection