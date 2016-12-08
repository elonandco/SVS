angular.module('SVS.directives')
.directive('vendorServices', [ '$http', function($http){
	// Runs during compile
	return {
		scope: {
			action: '@'
		}, // {} = isolate, true = child, false/undefined = no change
		restrict: 'EA', // E = Element, A = Attribute, C = Class, M = Comment
		template: '<div><a class="edit-link" ng-click="isEditing=!isEditing">{{ isEditing ? "Done" : "Edit"}}</a><ul class="services-list"><li class="service-item" ng-repeat="service in services"><a href class="delete" ng-show="isEditing" ng-click="removeService($index)">x</a> {{service.name}}</li><li ng-show="isEditing"><input type="text" class="form-control" ng-model="newService" ng-keyup="$event.keyCode == 13 && addService()" placeholder="Add a new service" /></li></ul></div>',
		replace: true,
		transclude: 'true',
		controller: function($scope) {

			$scope.services = [];
			$scope.isSubmitting = false;
			$scope.isEditing = false;
			
			$scope.getServices = function () {
				$http.get($scope.action).success(function(data){
					$scope.services = data;
				})
			}

			$scope.removeService = function ($index) {
				$http.delete($scope.action + '/' + $scope.services[$index].id).success(function(data){
					if(data.success){
						$scope.services = data.services;
					}
				})
			}

			$scope.addService = function () {
				if($scope.newService.trim()){
					$scope.isSubmitting = true;
					$http.post($scope.action, {name:$scope.newService}).success(function(data){
						$scope.newService = '';
						$scope.services = data.services;
					})
				}
				
			}

			$scope.getServices();

		}
	};
}]);