angular.module('SVS.controllers')

.controller('selectedVendors', [
	'$scope', '$location', 'URL', 'vendorService', 
	function($scope, $location, URL, vendorService){
		
		$scope.selectedVendors = [];

		var getBidVendors = function () {
			vendorService.getBidVendors().then(function(response){
				$scope.selectedVendors = response.data;
			})
		};

		$scope.removeFromBid = function (vendor_id) {
			vendorService.removeVendorFromBid(vendor_id).then(function(response){
				$scope.selectedVendors = response.data;
			})
		};


		getBidVendors();

	}
]);