@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <div id="login-overlay" class="modal-dialog">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="well">
                    {!! Form::open(['url' => 'auth/login', 'id' => 'frmLogin', 'name' => 'login-form' ]) !!}
                    <div class="form-group">
                        <label for="username" class="control-label">Email</label>
                        {!! Form::text('email','', array('class' => 'form-control','placeholder' => 'Email id')) !!}
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        {!! Form::password('password', array('class' => 'form-control','placeholder' => 'Password')) !!}
                        <span class="help-block"></span>
                    </div>
                    <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>

                    <button type="submit" class="btn btn1 btn-block">Login</button>
                    <button class="btn btn2 btn-block" onclick="return false;">Help to login</button>
                    {!! Form::close() !!}
                </div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       
                        {!! session('error') !!}
                        {!! session()->flush() !!}
                    </div>
                @endif
            </div>
            <div class="col-md-2"></div>
        </div>
  </div>
<div>

@stop