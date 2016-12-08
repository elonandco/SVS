@if ( $vendor->hero )
<div class="section hero" style="background-image:url({{$vendor->hero}})">
@else
<div class="section hero">
@endif
	<div class="hero-wrapper">
		<div class="container">
			<div class="hero-content">
				<div class="avatar profile-avatar">
					<img src="{{ $vendor->user->avatar }}" id="avatar" alt="">
				</div>
				<div class="company">{{$vendor->name}}</div>
				@if ( $vendor->category )
				<div class="category">{{ $vendor->category->name }}</div>
				@endif
			</div>
		</div>
	</div>
</div>