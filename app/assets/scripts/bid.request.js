(function($){
    Dropzone.autoDiscover = false;

	
    var myDropzone = new Dropzone(".dropzone", {
        url: window.dropUrl, 
        maxFilesize: 5,
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.pfd",
        previewsContainer: '.dz-previews',
        previewTemplate: document.querySelector('#preview-template').innerHTML
    });

    if(window.files) {
        $.each(window.files, function(index, val) {
            var mockFile = { id: val.id, name: val.filename, size: 1 };
            myDropzone.options.addedfile.call(myDropzone, mockFile);
            myDropzone.emit("success", mockFile);
        })

        
    }

    myDropzone.on('removedfile', function (file) {
        $.post(window.removeUrl + file.id); 
    })

    myDropzone.on('success', function (file, response) {
        file.id = response.id;
    })

    if(window.newBid === true) {
      $('form').garlic('destroy') 
      $('#bid_form')[0].reset(); 
    }
    

        

	var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var startDate = $('#start_date').fdatepicker({
    	
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > endDate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
           
            if(newDate.valueOf() > endDate.date.valueOf())
            	endDate.update(newDate);

            // if(dueDate.date.valueOf() && newDate.valueOf() > dueDate.date.valueOf())
            // 	dueDate.update(newDate);
        }
        startDate.hide();
        $('#end_date')[0].focus();
    }).data('datepicker');


    var endDate = $('#end_date').fdatepicker({
    	format: 'mm/dd/yyyy',
        onRender: function (date) {
            return date.valueOf() <= startDate.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        endDate.hide();
    }).data('datepicker');

    var dueDate = $('#due_date').fdatepicker({
    	format: 'mm/dd/yyyy',
        onRender: function (date) {
            return date.valueOf() <= now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        endDate.hide();
    }).data('datepicker');

}(jQuery))
	