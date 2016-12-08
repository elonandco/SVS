angular.module('SVS.services')

.factory('$modal', [ 
	'$http', '$templateCache', '$compile', '$rootScope', 
	function( $http, $templateCache, $compile, $rootScope){

	var modalContainer = $('#modal');


	var showModalContent = function (response) {
		modalScope = $rootScope.$new(true);
		modalContent = $compile(response.data)(modalScope);
		modalContainer.addClass('active').html(modalContent);
	}

	return {

		open: function (options) {
			$http.get(options.templateUrl, {cache: $templateCache}).then(showModalContent)
		}
	}
}]);