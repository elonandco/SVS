<div class="section">
	<div class="container">
	<div class="page-title centered">
		<h2 class="bid-title"><small>Bids For</small> {{ $bid->type }}</h2>
		@if($bid->responses)
			<small class="bid-response-count">{{$bid->responses->count()}} {{ $bid->responses->count() == 1 ? 'Response' : 'Responses' }}</small>
		@endif
	</div>
		
		
	</div>
</div>
<div class="section">
	<div class="container">
		<ul class="bids-listing">
			@foreach($bid->vendors as $vendor)
			<li class="bid-listing-item">
				<div class="vendor-image"><img src="{{$vendor->user->avatar}}" alt=""></div>
				
				<div class="vendor-name"><a href="{{ URL::route('vendor_profile', $vendor->slug) }}">{{$vendor->name}}</a></div>
				@if($vendor->bid_response)
					<div class="vendor-date">Submitted: 
					@if($vendor->bid_response_timestamp->diffInDays() < 1)
						{{$vendor->bid_response_timestamp->diffInHours()}} hours ago
					@else
						{{$vendor->bid_response_timestamp->diffInDays()}} days ago
					@endif
					</div>
				@endif

				<div class="vendor-bid">
				@if($vendor->bid_response)
					{{ money_format('%.2n', $vendor->bid_response) }}
				@else
					No Response
				@endif 
				</div>
			</li>
			@endforeach

		</ul>
	</div>
</div>