angular.module('SVS.directives')
.directive('vendorCertifications', [ '$http', function($http){
	// Runs during compile
	return {
		scope: {
			action: '@'
		}, // {} = isolate, true = child, false/undefined = no change
		restrict: 'EA', // E = Element, A = Attribute, C = Class, M = Comment
		template: '<div><a class="edit-link" ng-click="isEditing=!isEditing">{{ isEditing ? "Done" : "Edit"}}</a>' +
			 		'<table class="full">' + 
			 		'<thead><tr><th>Title</th><th>State</th><th>Accreditation #</th><th>Exp Date</th></tr></thead>' + 
			 		'<tr ng-repeat="cert in certifications"><td>{{cert.name}}</td><td>{{cert.state}}</td><td>{{cert.value}}</td><td>{{cert.date}}</td></tr>' + 
			 		'<tr><td><input type="text" class="form-control" ng-model="newCert.name" /></td><td><input type="text" class="form-control" ng-model="newCert.state" size="3" /></td><td><input type="text" class="form-control" ng-model="newCert.value" size="3" /></td><td><input type="text" class="form-control" ng-model="newCert.date" size="3" /></td></tr>' +
			 		'<tr><td colspan="4"> <a href ng-click="addCertifications()">Add</a> </td></tr>' +
			 		'</table></div>',
		replace: true,
		transclude: 'true',
		controller: function($scope) {

			$scope.certifications = [];
			$scope.newCert = {};
			$scope.isSubmitting = false;
			$scope.isEditing = false;
			
			$scope.getCertifications = function () {
				$http.get($scope.action).success(function(data){
					$scope.certifications = data.certifications;
				})
			}

			$scope.removeCertifications = function ($index) {
				$http.delete($scope.action + '/' + $scope.certifications[$index].id).success(function(data){
					if(data.success){
						$scope.certifications = data.certifications;
					}
				})
			}

			$scope.addCertifications = function () {
				if($scope.newCert.name){
					$scope.isSubmitting = true;
					$http.post($scope.action, $scope.newCert).success(function(data){
						$scope.newCert = {};
						$scope.certifications = data.certifications;
					})
				}
				
			}

			$scope.getCertifications();

		}
	};
}]);