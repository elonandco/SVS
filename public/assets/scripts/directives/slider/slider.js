angular.module('SVS.directives')

.directive('slider', function(){
	return {
		restrict: 'EA',
		scope: {
			slider: '='
		},
		template: '<div class="range-filter"><div class="selection"><div class="handle"></div></div></div>',
		link: function($scope, iElm, iAttrs, controller) {
 			var $doc = $(document);
 			var $el = $(iElm);
 			var $container = $el.find('.range-filter');
 			var $selection = $el.find('.selection');
 			var $handle = $el.find('.handle');

 			var ticks = 6;
 			var containerWidth = $container.width();
 			var sectionWidth = 1 / (ticks-1);
 			var units = ((containerWidth - ($handle.width()/2) ) / containerWidth);
 			var tempVal;

 			var containerOffset;

 			var touch = !!('ontouchstart' in window);
 			var events = {
					start : touch ? 'touchstart' : 'mousedown',
					move : touch ? 'touchmove' : 'mousemove',
					end : touch ? 'touchend' : 'mouseup'
				};


			var _limitTo = function(val, min, max) {
				return Math.min(Math.max(val, min), max);
			};

			var _onMove = function (event) {

				var currentX = touch ? event.originalEvent.targetTouches[0].clientX : event.clientX;
				
				var pos = _limitTo((currentX-containerOffset) / containerWidth, 0, 1);

				tempVal = Math.round(pos/sectionWidth);

				_updateHandle(tempVal);

				event.preventDefault();

			};

			var _onEnd = function (event) {

				$scope.$apply(function(){
					$scope.slider = tempVal;						
				});

				$doc.off(events.move, _onMove);
				$doc.off(events.end, _onEnd);

				event.preventDefault();


			};

			var _onStart = function (event) {

				event.preventDefault();

				containerOffset = $container.offset().left;

				$doc.on(events.move, _onMove);
				$doc.on(events.end, _onEnd);

				return false;

			};	

			var _updateHandle = function (newVal) {
		
				var newPos = (100/(ticks-1)) * units * newVal;

				$selection.css({
					left: newPos + '%'
				});

			};

			var _onModelChange = function (sliderVal, oldval) {
				if(sliderVal >= 0){
					_updateHandle(sliderVal)
				}
			}

			var _onClick = function (e) {
				
				var posX = $(this).position().left

				var pos = _limitTo((e.pageX - posX) / containerWidth, 0, 1);

				tempVal = Math.round(pos/sectionWidth);

				$scope.$apply(function(){
					$scope.slider = tempVal;						
				});
			}

			// $container.on('click', _onClick);
 			$handle.on(events.start, _onStart);
 			$scope.$watch('slider', _onModelChange);

 		}
	};
 });