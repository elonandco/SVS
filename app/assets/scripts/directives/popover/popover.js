angular.module('SVS.directives').

directive('popover', ['$compile', function($compile){
	// Runs during compile
	return {
		scope: {
			templateUrl: '@popover'
		}, 
		restrict: 'EA', // E = Element, A = Attribute, C = Class, M = Comment
		template: '<a href ng-click="toggle($event)" ng-transclude></a>',
		replace: true,
		transclude: true,
		link: function($scope, element, iAttrs, controller) {

			var popover;

			var close = function () {
				popover.remove();
				popover = false;
			}

			$scope.toggle = function ($event) {
				$event.stopPropagation();
				$event.preventDefault();

				if(popover){
					close();
				} else {
					popover = angular.element('<div class="popover"><div ng-include="templateUrl"></div></div>');
					element.after(popover);
					$compile(popover)($scope);
					
				}
			}

			angular.element(document).bind('click', function(event){
				if(popover && ! angular.element(event.target).closest('.popover').length){
					close();
				}
			})
		}
	};
}]);