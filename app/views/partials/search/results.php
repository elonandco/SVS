<div class="selected-vendors" ng-if="selectedVendors.length">
	<div class="selected-title">Some sort of copy here to describe this section</div>
	<div class="selected-list">
		<ul class="vendors">
			<li class="selected-vendor" ng-repeat="vendor in selectedVendors">
				<a href class="close" ng-click="removeFromBid(vendor.id)">X</a>
				<img ng-src="{{vendor.user.avatar}}" alt="">
				<p><a href="/profile/{{vendor.slug}}">{{vendor.name}}</a></p>
			</li>
		</ul>
	</div>
	<a href="/bids/new" class="selected-button">Request Quote</a>
</div>

<h2 class="results-count" ng-if="count===0">No Professionals Found</h2>
<h2 class="results-count" ng-if="count > 0">{{count}} professionals for your project</h2>
<div ng-if="!vendors">Loading...</div>
<ul class="vendor-results" ng-if="vendors.length > 0">
	<li class="vendor" ng-repeat="vendor in vendors">
		<a href class="vendor-add" ng-click="addToBid(vendor.id)">+</a>
		<div class="vendor-image"><img ng-src="{{vendor.user.avatar}}" alt=""></div>
		<div class="vendor-content">
			<div class="vendor-name"><a href="/profile/{{vendor.slug}}">{{vendor.name}}</a></div>
			<div class="vendor-details">{{vendor.categories[0].name}} &middot; {{vendor.city}}, {{vendor.state}} </div>
			<div class="vendor-rating"><span class="rating rating-{{vendor.reviews.rating}} rating-small"></span> {{vendor.reviews.total}} customer reviews</div>
			<div ng-repeat="document in vendor.documents" class="vendor-meta {{document.name}}">{{document.name}}</div>
		</div>
	</li>
</ul>

<div ng-show="count > vendors.length"><a href ng-click="loadMore()" class="cta action full">Show More</a></div>