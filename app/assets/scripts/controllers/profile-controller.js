angular.module('SVS.controllers')

.controller('profile', [
	'$scope', '$http', 'URL',
	function($scope, $http, URL){

		$scope.isEditing = false;
		$scope.data = {};
		$scope.editing = {};

		var get_vendor_error = function () {
			// TODO: Failure
		}

		var get_vendor_success = function (data) {
			
			if(data.success){
				$scope.data.vendor = data.vendor;
			} else {
				get_vendor_error();
			}
		}

		var get_vendor = function () {
			$http.get('/vendor/' + $scope.slug)
				.success(get_vendor_success)
				.error(get_vendor_error)
		}

		var save_success = function (data, section) {
			if(data.success){
				$scope.editing[section] = false;
			} else if (data.errors) {
				// TODO: show errors
			}
			
		}

		$scope.edit = function (section) {
			$scope.editing[section] = true;
		}

		$scope.save = function (section) {
			$http.post('/vendor/' + $scope.slug, $scope.data).success(function(data){
				save_success(data, section)
			});
		}

		$scope.$watch('slug',get_vendor);
}])