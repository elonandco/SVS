angular.module('SVS.services')

.factory('vendorService', ['URL', '$q', '$http', function(URL, $q, $http){

	return {

		getBidVendors: function () {
			return $http.get(URL.bidVendors);
		},

		addVendorToBid: function (vendor_id) {
			return $http.post(URL.bidVendors, { id: vendor_id })
		},

		removeVendorFromBid: function (vendor_id) {
			return $http.delete(URL.bidVendors, {params: { id: vendor_id }})
		}

	}
}]);