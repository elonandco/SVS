@extends('layouts.default')
@section('content')
	@include('partials.vendors.profile.hero')
	@include('partials.vendors.profile.menu')

	@if($isVendor)
		@include('pages.bids.listing.vendor')
	@else 
		@include('pages.bids.listing.user')
	@endif
@stop