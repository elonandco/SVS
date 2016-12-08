@extends('layouts.default')
@section('content')
	@include('partials.vendors.profile.hero')
	@include('partials.vendors.profile.menu')

	@if($isVendor)
		@include('pages.bids.view.vendor')
	@else 
		@include('pages.bids.view.user')
	@endif
@stop