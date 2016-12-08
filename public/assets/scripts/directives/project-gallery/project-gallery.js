angular.module('SVS.directives')
.directive('projectGallery', [ '$http', function($http){
	// Runs during compile
	return {
		// name: '',
		// priority: 1,
		// terminal: true,
		scope: {
			action: '@'
		}, // {} = isolate, true = child, false/undefined = no change
		// require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
		restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
		template: '<form><ul class="project-list"><li class="project-item" ng-repeat="image in images"><img ng-src="{{image.image_small}}" class="project-image" /></li><li class="project-item" ng-hide="hideInclude" ng-transclude></li></ul></form>',
		// templateUrl: '',
		replace: true,
		transclude: 'true',
		// compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
		link: function($scope, iElm, iAttrs, controller, transcludeFn) {

			$scope.images = [];
			$scope.hideInclude = true;
			
			$scope.getImages = function () {
				
				$http.get($scope.action).success(function(data){
					console.log('got it');
					$scope.images = data;
				})
			}

			$scope.getImages();


			$scope.onPhotoUpload = function(data){

				var formData = new FormData();
  					formData.append('image', data);

  				var xhr = new XMLHttpRequest();
					xhr.open('POST', $scope.action, true);
					xhr.onload = function(e) { 
						
						$scope.$apply(function () {
							$scope.images = JSON.parse(xhr.responseText);	
						});
						
					};

					xhr.send(formData);
			}

			// Hide the transclude content if it is empty
			transcludeFn($scope, function(clone) { 
               $scope.hideInclude = clone.text().trim().length;
            });
		}
	};
}]);