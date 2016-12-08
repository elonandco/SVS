@extends('layouts.default')
@section('content')
<div class="row">
	<div class="column">
		<div class="search-results" ng-controller="results">
			<div class="filters">
				@include('partials.search.filters')
			</div>
			<div class="results">
				@include('partials.search.results')
			</div>
		</div>
	</div>
</div>

@stop