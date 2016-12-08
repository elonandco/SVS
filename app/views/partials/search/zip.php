<p ng-if="locationError" class="filter-error">Please enter a valid zip code.</p>
<input type="text" class="text-input" ng-model="location">
<a href class="filter-button" ng-show="locationIsDirty" ng-click="updateGeolocation()">Update Results</a>