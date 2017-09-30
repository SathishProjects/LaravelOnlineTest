@extends('layouts.test_page')
@section('content')

<style type="text/css">
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 10px;
    padding: 10px 0px 10px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>


<div class="container">




    <div class="row">


        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall">
                <center><h2 class="text-danger">Online Test</h2></center>
                
                <form class="form-signin" id="frmLogin" name="login-form" method="post" action="/index.php/auth/login">

                {!! Form::text('email','', array('class' => 'form-control','placeholder' => 'Email id')) !!}
                {!! Form::password('password', array('class' => 'form-control','placeholder' => 'Password')) !!}
                <button class="btn btn-lg btn-danger btn-block" type="submit">
                    Sign in</button>

                    <a href="index.php/forgot_pwd" > Forgot password ? </a>
                
                
                {!! Form::close() !!}

                <center><b class="text-danger">Not Registered  ? </b><a href="index.php/signup" > Signup </a></center>

                                       

                

            </div>

            @if (session()->has('error'))
                    <div class="row">
                    <div class="col-xs-12">
                    <div class=" alert alert-danger" style="border-radius: 0px">
                       {!! session('error') !!}
                        {!! session()->flush() !!}
                    </div>
                    </div></div> 
                @endif
            
        </div>
    </div>


                    
</div>

@stop