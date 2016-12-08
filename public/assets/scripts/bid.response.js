(function(){

	window.SVS = window.SVS || {};

	SVS.bidResponse = function(){
		$('#bid-response-form').submit(function(){

			var $form = $( this );
			var errorList = $form.find('.errors');
			var data = $form.serialize();
			
			errorList.empty();

			$.post($form.attr('action'), data, function(result){
				if(result && result.success){
					$form.html('<p>' + result.message + '</p>');
					SVS.modal.close = function(){ location.reload(); }
				} else {
					errorList.html(result.message);
				}
			})	

			return false;		
		});

	}

}())
	