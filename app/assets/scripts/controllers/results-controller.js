angular.module('SVS.controllers')

.controller('results', [
	'$scope', '$location', 'URL', 'searchService', '$filter', '$modal', 
	function($scope, $location, URL, searchService, $filter, $modal){
	
	var query = $location.search();
	
	$scope.slider = { 
		distances: [1, 5, 10, 25, 50, 200],
	};

	$scope.vendors = [];

	$scope.selectedVendors = [];

	/* Meta Attributes */
	$scope.meta = {};

	/* Zip Code */
	$scope.location = null;

	$scope.locationIsDirty = false;

	$scope.locationError = false;


	
	var searchSuccess = function (response) {
		if(response.data.success){
			$scope.vendors = $scope.vendors.concat(response.data.vendors);
			$scope.count = response.data.count;
		}
	}

	var updateSelectedCategories = function () {
		if(query.cat && $scope.categories){
			cats = query.cat.split(',');
			for (var i = $scope.categories.length - 1; i >= 0; i--) {
				if(cats.indexOf($scope.categories[i].id) >= 0){
					$scope.categories[i].checked = true;
				}
			};
		}
	}

	var updateSeachRadius = function () {
		if(query.radius){
			var index = $scope.slider.distances.indexOf(parseInt(query.radius));
			$scope.slider.value = index >= 0 ? index : 3 ;
		} else {
			$scope.slider.value = 3;
		}
	}

	var updateLocation = function () {
		if(query.location){
			$scope.location = query.location;
		}
	};

	var updateMeta = function () {
		if(query.meta){
			query.meta.split(',').forEach(function(val){
				$scope.meta[val] = true
			});
		}
	};

	var getBidVendors = function () {
		searchService.getBidVendors().then(function(response){
			$scope.selectedVendors = response.data;
		})
	};



	$scope.updateGeolocation = function () {

		$scope.hideFilters();

		searchService.getGeolocation($scope.location).then(function(result){

			$scope.locationIsDirty = false;
			$scope.locationError = false;

			$location.search('location', result.location);
			$location.search('latitude', result.latitude);
			$location.search('longitude', result.longitude);

		}, function(){
			$scope.locationError = true;
		})
	};


	var updateFilters = function () {
		query = $location.search();
		updateSelectedCategories();
		updateLocation();
		updateMeta();
		updateSeachRadius();
	};

	var search = function () {

		query = $location.search();
		updateFilters();

		$scope.vendors = [];
		$scope.count = null;

		searchService.search(query).then(searchSuccess);
	};

	$scope.loadMore = function () {

		query = $location.search();
		query.offset = $scope.vendors.length;

		searchService.search(query).then(searchSuccess);
	};

	searchService.getCategories(query.q).then(function(response){
		$scope.categories = response.data.categories;
		
		/* Check the relevant categories */
		$scope.categories.forEach(function(obj){
			if(obj.relevance){
				obj.checked = true;
			}
		});

		updateFilters();
	});

	$scope.addToBid = function (vendor_id) {	
		searchService.addVendorToBid(vendor_id).then(function(response){
			if(response.data){
				$scope.selectedVendors = response.data;
			}
		});
	};

	$scope.removeFromBid = function (vendor_id) {
		searchService.removeVendorFromBid(vendor_id).then(function(response){
			$scope.selectedVendors = response.data;
		})
	};

	$scope.hideFilters = function () {
		$('body').removeClass('show-filters');
	}

	
	$scope.$watch('slider.value', function(newVal, oldVal){
		if(newVal !== oldVal){
			$location.search('radius', $scope.slider.distances[newVal]);
		}
	});


	$scope.$watch('categories|filter:{checked:true}', function (selectedCategories, oldCategories) {		
		if(oldCategories && selectedCategories.length != oldCategories.length){
			var dataArray = new Array;
			for(var o in selectedCategories) {
			    dataArray.push(selectedCategories[o].id);
			}

			if(dataArray.length){
				$location.search('cat', dataArray.join(','));
			} else {
				$location.search('cat', null);	
			}
		}
	}, true);


	$scope.$watch('meta', function(meta, old){
			
			if(meta === old){ return; }

			var dataArray = new Array;

			for(o in meta){
				if(meta[o] == true){
					dataArray.push(o);
				}
			}
			
			if(dataArray.length){
				$location.search('meta', dataArray.join(','));	
			} else {
				$location.search('meta', null);	
			}
				
	}, true);

	/* Check for user location updates */
	$scope.$watch('location', function (newLocation, oldLocation) {
		if(query.location && newLocation !==query.location){
			$scope.locationIsDirty = true;
		} else {
			$scope.locationIsDirty = false;
			$scope.locationError = false;
		}
	});

	$scope.$on('$locationChangeSuccess', search);

	updateSeachRadius();
	getBidVendors();

}])