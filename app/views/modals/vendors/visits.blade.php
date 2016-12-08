@extends('layouts.modal')
@section('content')
		<h1 class="modal-title">Views</h1>
		<div class="modal-section">
			<ul class="visits">
				@foreach ($visits as $visit)
					<li class="visit">
						<div class="visit-avatar"><img src="{{$visit->user->avatar}}" alt=""></div>
						<div class="visit-name">{{$visit->user->name}}</div>
						<div class="visit-company">{{$visit->user->vendors->first()->name}}</div>
						@if($visit->updated_at->diffInDays() < 1)
							<div class="visit-date">{{$visit->updated_at->diffInHours()}}h</div>
						@else
							<div class="visit-date">{{$visit->updated_at->diffInDays()}}d</div>
						@endif
						
					</li>
				@endforeach
			</ul>
		</div>
@stop