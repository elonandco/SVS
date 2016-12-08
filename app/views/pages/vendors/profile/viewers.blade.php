@extends('layouts.default')
@section('content')
	@include('partials.vendors.profile.hero')
	@include('partials.vendors.profile.menu')

	<div class="row">
		<div class="column">
			<h2 class="page-title">Managers who have viewed you</h2>
			
			@if (!count($visits))
				<div class="section-title">You have no recent viewers</div>
			@else
				<div class="row">
				<?php $i=1; ?>
				@foreach ($visits as $visit)
					<div class="column medium-4 <?php if($i == count($visits)){ echo ' end'; }  ?>">
						<div class="profile-viewer">
							<div class="viewer-avatar"><img src="{{$visit->user->avatar}}" alt=""></div>
							<div class="viewer-details">
								<div class="viewer-name"><a href="/profile/{{$visit->user->vendors->first()->slug}}">{{$visit->user->first_name}} {{$visit->user->last_name}}</a></div>
								<div class="viewer-company">{{$visit->user->vendors->first()->name}}</div>	
							</div>
							<div class="viewer-dates">
								<div class="row">
									<div class="column large-6">
										<div class="viewer-date-label">Viewed You</div>
										<div class="viewer-date-value">
											@if($visit->updated_at->diffInDays() < 1)
												{{$visit->updated_at->diffInHours()}} hours ago
											@else
												{{$visit->updated_at->diffInDays()}} days ago
											@endif
										</div>

									</div>
								</div>
							</div>
							
						</div>
					</div>
					<?php $i++; ?>
				@endforeach
				</div>
			@endif
		</div>
	</div>

@stop