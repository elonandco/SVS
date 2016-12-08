<div class="section sub-nav">
	<div class="container">

		@if($isVendor && $vendor->user->id == Auth::id() )
			@if(isset($breakdown))
				<div class="reviews">@include('partials.common.rating', array('rating'=>$breakdown->rating, 'size' => 'small' )) {{$breakdown->total}} customer reviews</div>
			@endif

			<ul class="nav-list">
				<li class="nav-item">
					<a href="{{ URL::route('vendor_profile_viewers', array('slug' => $vendor->slug)) }}" class="nav-link">
						Views 
						@if ( $vendor->recentVisitsCount > 0 )
							<span class="badge">{{ $vendor->recentVisitsCount }}</span>
						@endif
					</a>
				</li>
				<li class="nav-item">
					<a href="/bids" class="nav-link">Bid requests
						@if ( count($vendor->bids) > 0 )
							<span class="badge">{{ count($vendor->bids) }}</span>
						@endif
					</a>
				</li>
				<li class="nav-item"><a href="#" class="nav-link">Advertising</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Account settings</a></li>
			</ul>

		@endif

	</div>
</div>