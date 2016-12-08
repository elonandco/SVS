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