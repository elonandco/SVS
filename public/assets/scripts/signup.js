(function(){

	window.SVS = window.SVS || {};

	SVS.signup = function(){
		$('#signup-form-vendor, #signup-form-community').submit(function(){

			var $form = $( this );
			var errorList = $form.find('.errors');
			var data = $form.serialize();
			
			errorList.empty();

			$.post($form.attr('action'), data, function(result){
				if(result && result.success){
					SVS.modal.load('/modal/signup/confirm');
				} else {
					for (var i = 0; i < result.errors.length; i++) {
						errorList.append($('<li>').html(result.errors[i]));
					};
				}
			})

			return false;
		});

		$('.signup-cta').click(function(){
			$('#signup-modal').addClass('show-form');
			var parent = $(this).parent();
			
			if(parent.hasClass('vendor')){
				parent.closest('.modal-content').addClass('wide');
				$('.signup-form-community').hide()
			} else {
				parent.closest('.modal-content').removeClass('wide');
				$('.signup-form-vendor').hide()
			}
		})
	}

}())
	