$(document).ready(function() {
	modules.initialize();
	// setInterval(function() {refresh_page()}, 1000);
	hide.initialize();
	trainee.toggle();
	view_all.autoReload();
	question.initialize();
	$(window).scroll(function() {
		stick_Sidebar.initialize();
	});
	close_panel.initialize();
	$('#users-table').DataTable({
		"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25
	});
	$('.module-table').DataTable({
		"lengthMenu": [ [5, 20, 50, 100, -1], [5, 20, 50, 100, "All"]],
		"pageLength": 5
	});
});

var question = {
	initialize: function() {
		$('.show_d').click(function() {
			if ($(this).text() == "Show Details") {
				$(this).text('Hide Details');
				$(this).parent().parent().children('.item-body').css({'display':'block'});	
			} else {
				$(this).text('Show Details');
				$(this).parent().parent().children('.item-body').css({'display':'none'});					
			}
		});
	},
	add: function() {
		$('#choices-li').append('<label class="checkbox"><input type="checkbox" name = "question[answers][]" value = "'+$('.checkbox').length+'"><input type = "text" class = "choices" name = "choices[]"><span class = "text-error text-size-s2" onclick = "question.del(this)">del</span></label>');	

		console.log($('.choices').length);

		
	},
	del: function($d) {
		$($d).parent().remove();
	}
}

var stick_Sidebar = {
	initialize: function() {
		if ($(window).scrollTop() > 126){ 
			$h = $(window).scrollTop() - 126;
			$('#sidebar-content').css({'margin-top': $h+'px'}); 
		} else {
			$('#sidebar-content').css({'margin-top': '5px'});
		}
	}
}


var modules = {
	initialize: function() {
		$("#list-container").hide();
		$("#grid-container").show();

		// $("#grid-container").hide();		
		// $("#list-container").show();

		$flag_m = null;
		$('.module-box').click (function () {
			if($flag_m != this) {
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
				$flag_m = this;
			} else {
				$('.module-box').css('border','2px solid #dddddd');
				$('.module-box').height(200);
				$('.check').remove();
				$('.mb-title').removeClass('mod_active');
				$('.actions').removeClass('active_mod');
				$flag_m = null;
			}

		}); 

		$('.list-box').click (function(){
			if ($flag_m != this) {
				$('.li-check').remove();
				$('.list-box').removeClass('li-active');
				$('.list-box').children('.actions').hide();				

				$(this).children('.actions').show();
				$(this).prepend('<div class = "li-check"></div>');
				$(this).addClass('li-active');	
				$flag_m = this;
			} else {
				$(this).removeClass('li-active');
				$('.li-check').remove();	
				$('.list-box').children('.actions').hide();	
				$flag_m = null;
			}
		});

	},
	toggle_to_grid: function() {
		$('#module-list-panel-title').text("Module List : Grid View");
		$("#list-container").hide();
		$("#grid-container").fadeIn();
	},
	toggle_to_list: function() {
		$('#module-list-panel-title').text("Module List : List View");
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

var close_panel = {
	initialize: function() {
		$('.close-panel').click(function() {
			$(this).parent().css('display','none');
		});
	}
}

var admin_view = {
	filter: function() {
		var value = $("#filter").val();
		if (value === "admin") {
			$("td")
		} else if (value === "trainee") {

		} else if (value === "content_manager") {

		} else {

		}
	}
}