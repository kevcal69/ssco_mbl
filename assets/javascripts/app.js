$(document).ready(function() {
  modules.initialize();
  trainee.toggle();
  view_all.autoReload();
  // setInterval(function() {refresh_page()}, 100);

});

var modules = {
	initialize: function() {
		$("#list-container").hide();
		$("#grid-container").show();


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