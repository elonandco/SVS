@extends('layouts.modal')
@section('content')
	<div class="signup-modal" id="signup-modal">
		<h1 class="modal-title">Sign Up</h1>
		<div class="signup-modal-content">
			<div class="signup-section community">
				<h2 class="signup-section-title">Find a vendor</h2>
				<p class="signup-text">Get quotes from muliptle vendors quick and easy.</p>
				<p class="signup-cta"><a href="javascript:;">click here</a></p>   
			</div>
			<div class="signup-section vendor">
				<h2 class="signup-section-title">Become a vendor</h2>
				<p class="signup-text">Manage your brand and Get quality leads you can build on</p>
				<p class="signup-cta"><a href="javascript:;">click here</a></p>
			</div>
			<div class="signup-form community signup-form-community modal-section">
				<div class="modal-section-title">Find a vendor</div>
				@include('partials.user.signup-community')
			</div>
			<div class="signup-form vendor signup-form-vendor modal-section">
				<div class="modal-section-title">Promote your business</div>
				@include('partials.user.signup-vendor')
			</div>
		</div>
	</div>
	
	<script>
	$.getScript("/assets/scripts/signup.js", function(){ SVS.signup() });
	</script>
@stop