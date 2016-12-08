/**
* SVS.directives Module
*
* Description
*/
angular.module('SVS.directives').

directive('fileUploader', [function(){
	// Runs during compile
	return {
		scope: {
			uploadCallback: '&'
		}, 
		
		template: '<div class="file-uploader"><a href ng-click="upload()" ng-hide="uploading" ng-transclude></a><input type="file" class="hidden" style="position: absolute; height:0; width: 0;" accept="image/*" capture="camera"></div>',
		replace: true,
		transclude: true,
		link: function($scope, el, attrs) {

			var children = el.children();

			$scope.input = children[1];			

			$scope.upload = function () {
		    	$scope.input.click();
		    };

			$scope.onFileChange = function (event) {
		    	console.log('change');
		    	var file = this.files[0];

		    	$scope.$apply(function(){
		    		$scope.uploadCallback({data:file});
		    	});
		    }

		    angular.element($scope.input).bind('change', $scope.onFileChange);
			
		}
	};
}]);