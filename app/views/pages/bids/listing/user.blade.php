<div class="row">
	<div class="column">
		
		<ul class="bid-requested-list">
			<li class="bids-requested-item">
				<a href="{{ URL::route('new_bid') }}" class="bids-requested-link new-bid">
					<span class="new-bid-text">Request New Bid</span>
				</a>
			</li>
			
			@foreach ($bids as $bid)
			<li class="bids-requested-item">
				<a href="{{ URL::route('view_bid', array('id' => $bid->id)) }}" class="bids-requested-link">
					<div class="bid-time">{{ HTMLHelpers::timeAgo($bid->updated_at) }}</div>
					<div class="bid-name">{{ $bid->type }}</div>
					
					<div>
						@foreach ($bid->vendors as $index => $vendor)
							<div class="bid-image" style="background-image: url('{{$vendor->user->avatar}}');">
								@if($index == 0 &&  $bid->responses)
									<div class="bid-response-count">{{$bid->responses->count()}} {{ $bid->responses->count() == 1 ? 'Response' : 'Responses' }}</div>
								@endif
							</div>
						@endforeach
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>