(function(){

	window.SVS = window.SVS || {};

	SVS.login = function(){
		$('#login-form').submit(function(){

			var $form = $( this );
			var errorList = $form.find('.errors');
			var data = $form.serialize();
			
			errorList.empty();

			$.post($form.attr('action'), data, function(result){
				if(result && result.success){
					location.reload();
				} else {
					errorList.html(result.message);
				}
			})	

			return false;		
		});

	}

}())
	