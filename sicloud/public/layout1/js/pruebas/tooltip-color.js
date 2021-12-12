$('[data-toggle="tooltip"]').each(function(){
    var options = { 
    	html: true 
    };

    if ($(this)[0].hasAttribute('data-type')) {
        options['template'] = 
        	'<div class="tooltip ' + $(this).attr('data-type') + '" role="tooltip">' + 
        	'	<div class="arrow"></div>' + 
        	'	<div class="tooltip-inner"></div>' + 
        	'</div>';
    }

    $(this).tooltip(options);
});