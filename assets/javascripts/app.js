$(document).ready(function() {
	modules.initialize();
	// setInterval(function() {refresh_page()}, 1000);
	hide.initialize();
	trainee.toggle();
	view_all.autoReload();
	$(window).scroll(function() {
		stick_Sidebar.initialize();
	});
});

var stick_Sidebar = {
	initialize: function() {
		if ($(window).scrollTop() > 126){ 
			$h = $(window).scrollTop() - 126;
			$('#sidebar-content').css({'margin-top': $h+'px'}); 
		} else {
			$('#sidebar-content').css({'margin-top': '10px'});
		}
	}
}


var modules = {
	initialize: function() {
		// $("#list-container").hide();
		// $("#grid-container").show();

		$("#grid-container").hide();		
		$("#list-container").show();

		$flag_m = '1';
		$flag_c = 200;

		$('.module-box').click (function () {
			if($flag_m == '1') {
				$('.module-box').css('border','2px solid #dddddd');
				$('.module-box').height(200);
				$('.check').remove();
				$('.mb-title').removeClass('mod_active');
				$('.actions').removeClass('active_mod');

				$(this).height($(this).height() + 40);
				console.log(""+$(this).height());
				$(this).children('.actions').addClass('active_mod');
				$(this).children('.mb-title').addClass('mod_active');
				$(this).prepend('<div class = "check"></div>');
				$(this).css('border', '4px solid #54B948');					
				$flag_m = '0';
			} else {
				$('.module-box').css('border','2px solid #dddddd');
				$('.module-box').height(200);
				$('.check').remove();
				$('.mb-title').removeClass('mod_active');
				$('.actions').removeClass('active_mod');
				$flag_m = '1';
				
			}

		}); 

	},
	toggle_to_grid: function() {
		$("#list-container").hide();
		$("#grid-container").fadeIn();
	},
	toggle_to_list: function() {
		$("#grid-container").hide();
		$("#list-container").fadeIn();
	},
	toggle_title: function() {
		$("#title-create").show();
	},

	box_click: function($el) {
		$('.module-box').css('border','2px solid #dddddd');
		$('.mb-title').css('margin-top', '-5px');
		$('.check').remove();

		$($el).unbind( "click" );

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
