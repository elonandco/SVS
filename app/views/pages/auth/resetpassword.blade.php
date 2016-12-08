@extends('layouts.default')
@section('content')
	
	<div class="section">
		<div class="container">
		<h2 class="page-title">Reset Your Password</h2>
		<form method="POST" class="page-form" action="{{{ URL::to('/users/reset_password') }}}" accept-charset="UTF-8">
		    <input type="hidden" name="token" value="{{{ $token }}}">
		    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

		    <div class="form-group">
		        <label for="password">New Password</label>
		        <div class="form-control-wrapper">
		        	<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
		        	<button type="submit" class="cta btn btn-primary">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
		        </div>
		        
		    </div>

		    @if (Session::get('error'))
		        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
		    @endif

		    @if (Session::get('notice'))
		        <div class="alert">{{{ Session::get('notice') }}}</div>
		    @endif

		    <div class="form-actions form-group">
		        
		    </div>
		</form>

		</div>
	</div>
@stop