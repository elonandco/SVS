@extends('layouts.modal')
@section('content')
		<h1 class="modal-title">Log In</h1>
		<div class="modal-section">
			@include('partials.user.login')
		</div>
		<script>
		$.getScript("/assets/scripts/login.js", function(){ SVS.login() });
		</script>
@stop