@extends('layouts.default')
@section('content')
	
	@if ( $isOwner )
		@include('partials.vendors.profile.hero-owner')
	@else
		@include('partials.vendors.profile.hero')
	@endif

	
	@include('partials.vendors.profile.menu')

	

	<div class="section">
		<div class="container">
			@if($isVendor)
				<h2 class="page-title">Company Profile</h2>
			@else 
				<h2 class="page-title">Property Profile</h2>
			@endif
		</div>
	</div>

	<div ng-controller="profile" ng-init="slug='<?= $vendor->slug; ?>'">
		@include('pages.vendors.profile.info')
		@include('pages.vendors.profile.description')
	</div>


	@if($isVendor)
		
		@include('pages.vendors.profile.services')
		@include('pages.vendors.profile.certifications')
		@include('pages.vendors.profile.projects')
		@include('pages.vendors.profile.reviews')

	@endif

    
@stop