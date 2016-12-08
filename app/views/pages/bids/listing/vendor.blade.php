<div class="row">
	<div class="column">
		<h2 class="page-title">Incoming Bids</h2>

	<div class="bid-recieved-list">
		@foreach ($bids as $bid)

			<div class="bid-recieved-item">
				<div class="bid-image"><img src="{{$bid->user->avatar}}" alt=""></div>
				<div class="bid-content">
					<div class="bid-name">{{ $bid->type }}</div>
					@if ($bid->expired)
						<div class="bid-due-date">Expire</div>
					@else
						<div class="bid-due-date">{{ HTMLHelpers::timeAgo($bid->due, true) }}</div>
					@endif
					<div class="bid-description">{{ $bid->description }}</div>
					<ul class="bid-actions">
						<li class="bid-action-item"><a href="{{ URL::route('vendor_profile', $bid->user->slug) }}" class="bid-action-link cta link">View Profile</a></li>
						<li class="bid-action-item"><a href="#" class="bid-action-link cta disabled">Download Attachments</a></li>
						
						@if(!$bid->expired || $bid->response)
							<li class="bid-action-item">
								@if( !$bid->response )
									<a href="/bids/{{ $bid->id }}/response" class="bid-action-link cta action modal-cta">Place Bid</a>
								@else
									<span class="bid-action-link cta disabled">Bid Placed</span>
								@endif
							</li>
						@endif
							
					</ul>
				</div>
			</div>
		@endforeach
	</div>
</div>