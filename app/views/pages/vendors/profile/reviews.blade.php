<div class="section">
	<div class="container">
		<h3 class="section-title">Customer Reviews</h3>
		<div class="breakdown">
			@include('partials.common.rating', array('rating'=>$breakdown->rating ))

			@foreach ($breakdown->counts as $key => $count)
				<div class="breakdown-item">
					{{ $key }} star 
					<span class="breakdown-bar">
						<span style=" width: {{ $count['value'] }}%"></span>
					</span>
				</div>
			@endforeach
		</div>
			
		<div class="reviews" id="reviews">
			@foreach ($reviews as $review)
				<div class="review">
					<div class="review-title">
						@include('partials.common.rating', array('rating'=>$review->averageRating(), 'size'=>'small' ))
						An essential case for the HTC One M8 that offers fantastic protection but some bulk
					</div>
					<p class="review-meta">by {{ $review->user->name }} on {{ $review->created_at->format('F j, Y') }}</p>
					<p class="review-comments">{{ nl2br($review->comments) }}</p>
				</div>
			@endforeach
		</div>
	</div>
</div>