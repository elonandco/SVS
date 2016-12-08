@extends('layouts.modal')
@section('content')
	<h1 class="modal-title">Reset Your Password</h1>
	<div class="modal-section">
		@include('partials.user.forgot')
	</div>

	<script>
	$.getScript("/assets/scripts/forgot.js", function(){ SVS.forgot() });
	</script>
	
@stop