(function(){

	window.SVS = window.SVS || {};

	SVS.forgot = function(){
		$('#forgot-form').submit(function(){

			var $form = $( this );
			var errorList = $form.find('.errors');
			var data = $form.serialize();
			
			errorList.empty();

			$.post($form.attr('action'), data, function(result){
				if(result && result.success){
					$form.html('<p>' + result.message + '</p>');
				} else {
					errorList.html(result.message);
				}
			})	

			return false;		
		});

	}

}())
	