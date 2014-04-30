$(document).ready(function() {
  module_listing.initialize();
});

var module_listing = {
	initialize: function() {
		$("#list-container").hide();
		$("#grid-container").show();
	},
	toggle_to_grid: function() {
		$("#list-container").hide();
		$("#grid-container").show();
	},
	toggle_to_list: function() {
		$("#list-container").show();
		$("#grid-container").hide();	
	},
		
};