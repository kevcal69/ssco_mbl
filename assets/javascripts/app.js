$(document).ready(function() {
  modules.initialize();
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
	

	            

            
		