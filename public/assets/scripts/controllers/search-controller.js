angular.module('SVS.controllers')

.controller('search', ['$scope', '$location', 'URL', function($scope, $location, URL){

	var query = $location.search();

	$scope.q = query.q;
	$scope.location = query.location;
	
	var geocoder = new google.maps.Geocoder();

	var parseGeoResults = function (results, status) {

		if (status == google.maps.GeocoderStatus.OK){
			
			var params = $.param({
				q: $scope.q.value || $scope.q,
				location: $scope.location,
				latitude: results[0].geometry.location.lat(),
				longitude: results[0].geometry.location.lng()
			});
			
			document.location = URL.search + '#/?' + params;
			

		} else {
			alert('Not A Real Location');
		}
	};

	$scope.search =  function($event) {
		
		$event.preventDefault();
		if($scope.location && ($scope.q || $scope.q.value) ){
			geocoder.geocode({address: $scope.location}, parseGeoResults)	
		}else{
			console.log('error', $scope.q);
		}
	}
	
	var substringMatcher = function(strs) {
		
		return function findMatches(q, cb) {
			
			var matches, substringRegex;

			matches = [];

			substrRegex = new RegExp(q, 'i');

			$.each(strs, function(i, str) {
				if (substrRegex.test(str)) {
					matches.push({value: str});
				}
			});

			cb(matches);
		};
	};

	$scope.categories = window.categories;
	$scope.dataset = {
		source: substringMatcher(window.categories)
	};
	$scope.typeaheadOptions = {
		hint: false,
		highlight: true,
		minLength: 2
	}

}])
;