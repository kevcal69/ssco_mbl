$(document).ready(function() {
	modules.initialize();
	// setInterval(function() {refresh_page()}, 1000);
	setTimeout(function(){hide.notes_tips()},30000);
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
};

function refresh_page() {
	location.reload();
}
var hide = {
	notes_tips: function() {
		 var editor_height =  parseInt(edi.ui.space( 'contents' ).getStyle( 'height' ).replace("px","") )+  parseInt($("#instruction").height());
		$("#instruction").fadeOut();	
		edi.resize( '100%', editor_height , true )		
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
