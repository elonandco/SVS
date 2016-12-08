angular.module('SVS.services')

.factory('searchService', ['URL', '$q', '$http', function(URL, $q, $http){

	var geocoder = new google.maps.Geocoder();

	return {

		getGeolocation: function (location) {
			var deferred = $q.defer();

			geocoder.geocode({address: location}, function(results, status){
				if (status == google.maps.GeocoderStatus.OK){

					deferred.resolve({
						location: location,
						latitude: results[0].geometry.location.lat(),
						longitude: results[0].geometry.location.lng()
					});
					
				} else {
					deferred.reject();
				}
			})

			return deferred.promise;
		},

		search: function (args) {
			return $http.get(URL.searchApi, {params: args })
		},

		getCategories: function (query) {
			return $http.get(URL.categorySearch, {params: { q: query} })
		},

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