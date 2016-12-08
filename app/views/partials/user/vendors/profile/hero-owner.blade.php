@if ( $vendor->hero )
<div class="section hero" id="hero-image" style="background-image:url({{$vendor->hero}})">
@else
<div class="section hero" id="hero-image">
@endif
	<div class="hero-wrapper">		
		<div class="container">
			<div class="uploader" image-uploader name="hero" target="hero-image" action="{{{ URL::to('/vendor/' . $vendor->slug) }}}"><span class="edit-link hero-edit-link">Upload Photo</span></div>
			<div class="hero-content">				

				<div class="avatar profile-avatar">
					<img src="{{ $vendor->user->avatar }}" id="avatar" >
					<div class="uploader" image-uploader name="avatar" target="avatar" action="{{{ URL::to('/users/' . $vendor->user->id) }}}"><span class="edit-link">Edit</span></div>
				</div>

				<div class="company">{{$vendor->name}}</div>			
				
				@if ( $vendor->category )
				<div class="category">{{ $vendor->category->name }}</div>
				@endif

			</div>
		</div>
	</div>
</div>