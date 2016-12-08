
(function(){

	angular.module('SVS', ['SVS.directives', 'SVS.controllers', 'SVS.services']);
	angular.module('SVS.directives', []);
	angular.module('SVS.controllers', []);
	angular.module('SVS.services', []);

	angular.module('SVS').constant("URL", {
		search: '/search',
		searchApi: '/search/results',
		categorySearch: '/search/categories',
		bidVendors: '/bids/vendors'
	})

}())


window.SVS = {};

(function($){

	$('#mobile-menu, .menu-overlay').click(function (event) {
		event.preventDefault();
		$('body').toggleClass('show-nav');
	});

	$('#search-menu').click(function (event) {
		event.preventDefault();
		$('body').toggleClass('show-filters');
	});


	SVS.modal = (function () {

		_modal = $('#modal');

		var _loadResponse = function (response, status, xhr) {
			
			setTimeout(function(){
				_modal.addClass('active')
			},0);

			if (status == "error") {
				var msg = "Sorry but there was an error: ";
				
				_modal.html('<div class="modal-content modal-section"><a href="#" class="modal-close" onClick="SVS.modal.close();"></a>'+ msg + xhr.status + " " + xhr.statusText + "</div>");
			}
		};

		var _load = function (url, callback) {
			_modal.load(url, _loadResponse);
		};

		var _close = function () {
			_modal.removeClass('active');
		}

		return {
			load: _load,
			close: _close
		}

	}())

	var open_modal = function () {
		
		var target = $(this).attr('href');

		SVS.modal.load('/modal' + target)

		return false;
	}

	$('body').on('click','.modal-cta', open_modal)

}(jQuery))