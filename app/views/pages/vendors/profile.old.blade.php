@extends('layouts.default')
@section('content')
	
	<div class="section hero">
		<div class="container">
			<div class="hero-content">
				<div class="avatar profile-avatar">
					<img src="{{ $vendor->user->avatar }}" id="avatar" alt="">
					@if ( $isOwner )
						<div class="uploader" image-uploader name="avatar" target="avatar" action="{{{ URL::to('/users/' . $vendor->user->id) }}}"><span class="edit-link">Edit</span></div>
					@endif
				</div>
				@if ( $isOwner )
				<div editable-form action="{{{ URL::to('/vendor/' . $vendor->slug) }}}">
					<div class="company form-input" ng-model="$parent.formData.vendor.name">{{$vendor->name}}</div>
				</div>
				@else
				<div class="company">{{$vendor->name}}</div>
				@endif
				
				@if ( $vendor->category )
				<div class="category">{{ $vendor->category->name }}</div>
				@endif
			</div>
		</div>
	</div>


	
	@include('partials.vendors.profile.menu')
	

	<div class="section">
		<div class="container">
			<h2 class="page-title">Company Profile</h2>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="row">
					<div class="column large-8">
						<h3 class="section-title">Company Info</h3>
						@if ( $isOwner )
						<div class="section-editable" editable-form action="{{{ URL::to('/vendor/' . $vendor->slug) }}}">
						@else
						<div class="section-editable">
						@endif
							<div class="row">
								<div class="column medium-6">
									<p class="form-label">Address</p>
										@include('partials.common.address', array('address' => $vendor, 'model' => 'vendor'))
									<p class="form-label">Email</p>
									<p class="form-input" ng-model="$parent.formData.vendor.email">{{ $vendor->email }}</p>
									<p class="form-label">Website</p>
									<p class="form-input" ng-model="$parent.formData.vendor.url">{{ $vendor->url }}</p>
								</div>
								<div class="column medium-6">
									<p class="form-label">Phone</p>
									<p class="form-input" ng-model="$parent.formData.vendor.phone">{{ $vendor->phone }}</p>
								</div>
							</div>

						</div>
					</div>

					<div class="column large-4">
						<h3 class="section-title">Personal Info</h3>
						
						@if ( $isOwner )
						<div class="section-editable" editable-form action="{{{ URL::to('/users/' . $vendor->user->id) }}}">
						@else
						<div class="section-editable">
						@endif
							<p class="form-label">First Name:</p>
							<p class="form-input" ng-model="$parent.formData.user.first_name">{{{ $vendor->user->first_name }}}</p>
							<p class="form-label">Last Name:</p>
							<p class="form-input" ng-model="$parent.formData.user.last_name">{{{ $vendor->user->last_name }}}</p>
							<p class="form-label">Email address:</p>
							<p class="form-input" ng-model="$parent.formData.user.email">{{{ $vendor->user->email }}}</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<h3 class="section-title">Description</h3>
			@if ( $isOwner )
			<div class="section-editable" editable-form action="{{{ URL::to('/vendor/' . $vendor->slug) }}}">
				<p class="placeholder" ng-show="!$parent.data.isEditing && !$parent.formData.vendor.description ">Show off your work on Porch. The more projects added to your profile, the more likely homeowners will discover your services when browsing or searching for pros.</p>
			@else
			<div class="section-editable">
			@endif
				<p class="form-textarea" ng-model="$parent.formData.vendor.description">{{$vendor->description}}</p>

			</div>
		</div>
	</div>



	<div class="section">
		<div class="container">
			<h3 class="section-title">Services &amp; Expertise</h3>
			<div class="section-editable">
				@if ( $isOwner )
					<p>What services do you provide? Add your services & expertise and get previous customers to endorse them to add credibility to your profile. The more endorsements you receive, the higher your profile will rank in search results. </p>
					<div vendor-services action="{{{ URL::to('/vendor/' . $vendor->slug . '/services') }}}"></div>
				@else
					<ul>
					@foreach ($vendor->services as $service)
						<li>{{$service->name}}</li>
					@endforeach
					</ul>
				@endif

				
			</div>
		</div>
	</div>

	@include('pages.vendors.profile.certifications')

	<div class="section">
		<div class="container">
			<h3 class="section-title">Featured Projects</h3>
			<div class="section-editable">
				<p>Show off your work on Porch. The more projects added to your profile, the more likely homeowners will discover your services when browsing or searching for pros.</p>
			</div>
			<div class="project-gallery" project-gallery action="{{{ URL::to('/vendor/' . $vendor->slug . '/projects') }}}">
				@if ( $isOwner )
					<div file-uploader upload-callback="$parent.onPhotoUpload(data)" class="project-link"><span>Add project</span></div>
				@endif
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<h3 class="section-title">Customer Reviews</h3>
			<div class="breakdown">
				@include('partials.common.rating', array('rating'=>$breakdown->rating ))

				@foreach ($breakdown->counts as $key => $count)
					<div class="breakdown-item">
						{{ $key }} star 
						<span class="breakdown-bar">
							<span style=" width: {{ $count['value'] }}%"></span>
						</span>
					</div>
				@endforeach
			</div>
				
			<div class="reviews" id="reviews">
				@foreach ($reviews as $review)
					<div class="review">
						<div class="review-title">
							@include('partials.common.rating', array('rating'=>$review->averageRating(), 'size'=>'small' ))
							An essential case for the HTC One M8 that offers fantastic protection but some bulk
						</div>
						<p class="review-meta">by {{ $review->user->name }} on {{ $review->created_at->format('F j, Y') }}</p>
						<p class="review-comments">{{ nl2br($review->comments) }}</p>
					</div>
				@endforeach
			</div>
		</div>
	</div>

    
@stop