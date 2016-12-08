<div class="checkbox-option" ng-repeat="category in categories" ng-show="$index < 5 || showCategories">
	<input type="checkbox" name="selectedCategories[]" id="category_{{::category.id}}" class="category-input" ng-model="category.checked">
	<label for="category_{{::category.id}}" class="category-label">{{::category.name}}</label>
</div>
<a href ng-click="showCategories=true" class="more-link" ng-show="!showCategories">More</a>