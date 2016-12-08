angular.module('SVS.directives')

.directive('imageUploader', [function(){
	// Runs during compile
	return {
		// name: '',
		// priority: 1,
		// terminal: true,
		scope: {
			action: '@',
			name: '@',
			target: '@'
		},
		// controller: function($scope, $element, $attrs, $transclude) {},
		// require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
		restrict: 'EA', // E = Element, A = Attribute, C = Class, M = Comment
		template: '<div file-uploader upload-callback="onPhotoUpload(data)" class="project-link"><div ng-transclude></div></div>',
		// templateUrl: '',
		// replace: true,
		transclude: true,
		// compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
		link: function($scope, iElm, iAttrs, controller) {
			$scope.onPhotoUpload = function(data){

				var formData = new FormData();
  					formData.append($scope.name, data);

  				var xhr = new XMLHttpRequest();
					xhr.open('POST', $scope.action, true);
					xhr.onload = function(e) { 

						var response = JSON.parse(xhr.responseText);
						if(response.success && response.image){
							
							if($scope.target){
								var target = $('#' + $scope.target)
								if(target.prop("tagName").toLowerCase() == 'img'){
									target.attr('src', response.image);
								} else {
									target.css({'background-image': 'url(' + response.image + ')'});
								}
								
							}	
						}
						
						// $scope.$apply(function () {
						// 	$scope.images = JSON.parse(xhr.responseText);	
						// });
						
					};

					xhr.send(formData);
			}
		}
	};
}]);