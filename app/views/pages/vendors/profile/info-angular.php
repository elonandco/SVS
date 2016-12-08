<div>
	<a href class="edit-link" ng-click="edit('info')" ng-hide="editing.info">Edit</a>
	<a href class="edit-link" ng-click="save('info')" ng-show="editing.info">Save</a>
	<div class="row">
		<div class="column medium-6">
			
			<p class="form-label">Address</p>

			<p ng-hide="editing.info">{{ data.vendor.address }}</p>
			<p ng-show="!data.vendor.address && !editing.info"><a href ng-click="edit('info')">Add your Address</a></p>
			<p ng-show="editing.info"><input type="text" class="profile-input" ng-model="data.vendor.address" placeholder="Address"></p>
			<p>
				<span ng-hide="editing.info">{{ data.vendor.city }}</span>
				<span ng-show="editing.info"><input type="text" class="profile-input city" ng-model="data.vendor.city" placeholder="City"></span>

				<span ng-hide="editing.info">{{ data.vendor.state }}</span>
				<span ng-show="editing.info"><us-states state="data.vendor.state"></us-states></span>

				<span ng-hide="editing.info">{{ data.vendor.zip }}</span>
				<span ng-show="editing.info"><input type="text" class="profile-input zip" maxlength="5" ng-model="data.vendor.zip" placeholder="Zip"></span>
			</p>
			
			<p class="form-label">Website</p>
			<p ng-hide="editing.info">{{ data.vendor.url }}</p>
			<p ng-show="!data.vendor.url && !editing.info"><a href ng-click="edit('info')">Add your Website</a></p>
			<p ng-show="editing.info"><input type="text" class="profile-input" ng-model="data.vendor.url"></p>
		</div>
		<div class="column medium-6">
			<p class="form-label">Email</p>
			<p ng-hide="editing.info">{{ data.vendor.email }}</p>
			<p ng-show="!data.vendor.email && !editing.info"><a href ng-click="edit('info')">Add your Email</a></p>
			<p ng-show="editing.info"><input type="text" class="profile-input" ng-model="data.vendor.email"></p>

			<p class="form-label">Phone</p>
			<p ng-hide="editing.info">{{ data.vendor.phone }}</p>
			<p ng-show="!data.vendor.phone && !editing.info"><a href ng-click="edit('info')">Add your Phone Number</a></p>
			<p ng-show="editing.info"><input type="text" class="profile-input" ng-model="data.vendor.phone"></p>
		</div>
	</div>
</div>