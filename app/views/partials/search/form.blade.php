<form action="search" method="get" action="search/results" class="search-form" ng-controller="search">
	
	<div ng-bind-html-unsafe="q"></div>
	<div class="input-container profession">
		<label for="profession" class="search-label">Search</label>	
		<input type="text" class="search-input typeahead" options="typeaheadOptions" datasets="dataset" id="category-input" autocomplete="off" name="q" ng-model="q" placeholder="Roofers, Plumbers, etc">
	</div>
	<div class="input-container near">
		<label for="near" class="search-label">Near</label>
		<input type="text" class="search-input" name="location" ng-model="location" placeholder="City or Zip code">
	</div>
	<div class="input-container within">
		<label for="radius" class="search-label">Within</label>
		<select name="within" class="search-select">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50" selected="selected">50</option>
			<option value="75">75</option>
			<option value="100">100</option>
			<option value="150">150</option>
			<option value="200">200</option>
			<option value="150">250</option>
			<option value="500">500</option>
		</select>
	</div>
	<div class="button-container">
		<button type="submit" ng-click="search($event)" class="submit-button">Search Professionals</button>
	</div>
</form>