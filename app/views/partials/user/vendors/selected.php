<div ng-controller="selectedVendors">
	<ul class="vendors">
		<li class="selected-vendor" ng-repeat="vendor in selectedVendors">
			<div class="selected-vendor-content">
				<a href class="close" ng-click="removeFromBid(vendor.id)">X</a>
				<img ng-src="{{vendor.user.avatar}}" alt="">
				<p><a href="/profile/{{vendor.slug}}">{{vendor.name}}</a></p>
			</div>
		</li>
		<li class="selected-vendor">
			<a href="/" class="selected-vendor-content">
				<div class="add-link"><span>Add a vendor</span></div>
				<p>&nbsp;</p>
			</a>
		</li>
	</ul>
</div>