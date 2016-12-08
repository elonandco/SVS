<div class="filter-section">
	<div class="filter-title">About the professional</div>
	<div class="filter-description">Type of professsional:</div>
	<div class="filter-options">
		@include('partials.search.categories')	
	</div>
</div>
<div class="filter-section">
	<div class="filter-options">
		@include('partials.search.meta')
	</div>
</div>
<div class="filter-section">
	<div class="filter-title">Zip Code</div>
	<div class="filter-options">
		@include('partials.search.zip')
	</div>
</div>
<div class="filter-section">
	<div class="filter-title">Professional's location</div>
	@include('partials.search.radius')
</div>
<div class="filter-section">
	<a href="javascript:;" ng-click="hideFilters()" class="cta action hide-filters">Hide Filters</a>
</div>