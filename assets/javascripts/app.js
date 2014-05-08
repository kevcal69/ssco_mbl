$(document).ready(function() {
	modules.initialize();
	// setInterval(function() {refresh_page()}, 1000);
	hide.initialize();
	trainee.toggle();
	view_all.autoReload();
});

var modules = {
	initialize: function() {
		$("#list-container").hide();
		$("#grid-container").show();

		// $("#list-container").show();
		// $("#grid-container").hide();		


	},
	toggle_to_grid: function() {
		$("#list-container").fadeOut();
		$("#grid-container").fadeIn();
	},
	toggle_to_list: function() {
		$("#list-container").fadeIn();
		$("#grid-container").fadeOut();	
	},
	toggle_title: function() {
		$("#title-create").show();
	},

	box_click: function($el) {
		$('.module-box').css('border','2px solid #dddddd');
		$('.mb-title').css('margin-top', '-5px');
		$('.check').remove();

		$($el).bind( "mouseenter mouseleave" );


		$($el).prepend('<div class = "check"></div>');
		$($el).css('border', '4px solid #54B948');
		$($el).children('.mb-title').css('margin-top', '-105px');
	}
};

function refresh_page() {
	location.reload();
}
var hide = {
	initialize: function() {
		if (DCS.BODY_CLSS === "module create" || DCS.BODY_CLSS === "module modify")
			setTimeout(function(){hide.notes_tips()},30000);
	},

	notes_tips: function() {
		 var editor_height =  parseInt(edi.ui.space( 'contents' ).getStyle( 'height' ).replace("px","") )+  parseInt($("#instruction").height());
		$("#instruction").fadeOut();	
		edi.resize( '100%', editor_height , true );	
	}
}

var trainee = {
	toggle: function() {
		var value = $("#role").val();
		if (value === "trainee") {
			$(".trainee-name").fadeIn();
		} else {
			$(".trainee-name").fadeOut();
		}
	}
}

var view_all = {
	autoReload: function(){
  if (window.name=='autoreload') {
     location.reload();
     window.name='';
  }
}
}
