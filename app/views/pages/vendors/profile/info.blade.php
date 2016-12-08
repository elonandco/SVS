<div class="section">
	<div class="container">
		
		@if($isVendor)
			<h3 class="section-title">Company Info</h3>
		@else 
			<h3 class="section-title">Property Info</h3>
		@endif

		<div class="section-editable">
		
			@if ( $isOwner )
				@include('pages.vendors.profile.info-angular')
			@else
				<div class="row">
					<div class="column medium-6">
						<p class="form-label">Address</p>
						<p>{{ $vendor->address }}</p>
						<p>
							<span>{{ $vendor->city }}</span>
							<span>{{ $vendor->state }} </span>
							<span>{{ $vendor->zip }}</span>
						</p>
						
						<p class="form-label">Website</p>
						<p>{{ $vendor->url }}</p>
					</div>
					<div class="column medium-6">
						<p class="form-label">Email</p>
						<p>{{ $vendor->email }}</p>
						<p class="form-label">Phone</p>
						<p>{{ $vendor->phone }}</p>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>