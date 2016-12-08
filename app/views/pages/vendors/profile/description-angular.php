<div>
	<a href class="edit-link" ng-click="edit('description')" ng-hide="editing.description">Edit</a>
	<a href class="edit-link" ng-click="save('description')" ng-show="editing.description">Save</a>

	<p ng-hide="editing.description">{{data.vendor.description}}</p>
	<p ng-show="data.vendor && !data.vendor.description && !editing.description"><a href ng-click="edit('description')">Enter your company description.</a></p>
	<p ng-show="editing.description"><textarea class="profile-textarea" ng-model="data.vendor.description"></textarea></p>
</div>