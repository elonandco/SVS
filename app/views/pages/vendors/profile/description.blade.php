<div class="section">
	<div class="container">
		<h3 class="section-title">Description</h3>
		<div class="section-editable">

			@if ( $isOwner )
				@include('pages.vendors.profile.description-angular')
			@else
				<p>{{$vendor->description}}</p>
			@endif
		</div>
	</div>
</div>