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