$(document).ready(function() {
	code.initialize();
});

var code = {
	initialize: function() {
		// $('code').css('background-color', '#eeeeee');
		// $('code').css('padding', '10px 10px 10px 10px');
		// $('code').css('color', '#284c7e');
		// $('code').css('font-size', '12px');
		// $('code').css('color', '#284c7e');
		// $('code').css('border-left', '3px solid orange');
		// $('code').css('margin-left', '20px');		
	}
}

var editor_dimension = {
	initialize: function() {
		var $content_wrapper = $('#main-wrapper').height() - $('#main-header').height() ;
		$('#main-content').height($content_wrapper);
		$('#editor-container').height($content_wrapper);	
		return $content_wrapper;
	}
}