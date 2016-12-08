@extends('layouts.empty')
@section('content')

	<h1 class="logo">Select Vendor Services</h1>
	<div class="home-content">
		<h2 class="tagline">Search for professionals in your area</h2>
		@include('partials.search.form')
	</div>
	@if (Confide::user())
	<div class="menu">
		<a href="/logout" class="cta primary">Log Out</a>
	</div>
	@else
	<div class="menu">
		<a href="/signup" class="cta modal-cta primary">Sign Up</a>
		<a href="/login" class="cta  modal-cta secondary">Log In</a>
	</div>
	@endif
	<video autoplay  poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" loop>
	<source src="//demosthenes.info/assets/videos/polina.webm" type="video/webm">
	<script>
	window.categories = <?= $categories; ?>
	</script>

@stop