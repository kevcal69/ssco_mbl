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
		$("#qbody").on("change","#filter" ,function (e) {
			$val = $(this).children('option:selected').attr('value');
			$.ajax({
				type: "POST",
				url: MBL.BASE_URL+ "admin/question/question_filter", 
				data: { mid : $(this).data('mid') , val: $val},
				cache:false,
				success: 
				function(data){
					$temp = $('#results-filter');
					$("#qbody").empty();
					$("#qbody").append($temp);
					$("#qbody").append(data);
				}
			});
		}).on("click",".sh_mr", function () {
				if ($(this).text() == "Show More") {
					$(this).text('Hide');
					$(this).parent().parent().children('.item-body').css({'display':'block'});	
				} else {
					$(this).text('Show More');
					$(this).parent().parent().children('.item-body').css({'display':'none'});					
				}		
		}).on("click",".set-test", function(){
			console.log($(this).data('val'));
			console.log($(this).data('id'));
			console.log($(this).data('mid'));
			$.ajax({
				type: "POST",
				url: MBL.BASE_URL+ "admin/question/set_question", 
				data: { id : $(this).data('id'), mid : $(this).data('mid') , val: $(this).data('val')},
				cache:false,
				success: 
				function(data){
					location.reload();
				}
			});

		}).on("click",'.edit',function(e) { 
			$('.edit').bind('click', function(){ return false; });
			$(this).parent().parent().parent().find("*").not('#questionare, #questionare *').remove();
			$('#questionare').show();
			CKEDITOR.replace( 'edit-area', {
				resize_enabled : false,
				removePlugins : 'autosave',				
				toolbar: [
					[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
					{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
					'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
					{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
				],
			});
		});
	},
	add: function() {
		$('#choices-li').append('<label class="checkbox"><input type="checkbox" name = "question[answers][]" value = "'+$('.checkbox').length+'"><input type = "text" class = "choices" name = "question[choices][]"><span class = "text-error text-size-s2" onclick = "question.del(this)">del</span></label>');	
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
			$('#sidebar-content').css({'margin-top': '0px'});
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
		if (MBL.BODY_CLSS === "module create" || MBL.BODY_CLSS === "module modify")
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