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
	$('#users-table , .module-table-admin').DataTable({
		"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25
	});
	$('.module-table').DataTable({
		"lengthMenu": [ [5, 20, 50, 100, -1], [5, 20, 50, 100, "All"]],
		"pageLength": 5
	});

	test_form.initialize();
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
			$filter = $("#filter").children('option:selected').attr('value');
			$this = $(this);
			$.ajax({
				type: "POST",
				url: MBL.BASE_URL+ "admin/question/set_question", 
				data: { id : $(this).data('id'), mid : $(this).data('mid') , val: $(this).data('val')},
				cache:false,
				success: 
				function(data){
					if ($filter == 2) {
						location.reload();
					} else {
						$($this).parent().parent().parent().remove();
					}
					
				}
			});
		}).on("click",'.edit',function(e) { 
			$(".modal-container"+$(this).data('id')).show();
			$(".modal-container"+$(this).data('id')+" #popup #questionare").show();
		}).on("click",'.qedit',function(e) { 
			$(".modal-container"+$(this).data('id')).show();
			$(".modal-container"+$(this).data('id')+" #popup #questionare").show();
			console.log('edit'+$(this).data('id'));
		});
		$(".panel-heading").on("click","#conduct" ,function (e) {
			$("#filter").val('1');
			$('#conduct').after('<button type = "button" data-mid = "'+$(this).data('mid')+'" class = "button-warning" id = "confirm">Confirm Test</button>');
			$('#conduct').remove();
			$val = 1;
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
		}).on("click","#confirm" ,function (e) {
			$item_size = $('.item').size();
			if ($item_size == 0) {
				console.log($item_size);
				$("#confirm").text("Error! no items tagged");
				$("#confirm").removeClass("button-warning");
				$("#confirm").addClass("button-danger");

				setTimeout(function () {location.reload()},1000);
			}
			// $.ajax({
			// 	type: "POST",
			// 	url: MBL.BASE_URL+ "admin/question/conduct", 
			// 	data: { mid : $(this).data('mid')},
			// 	cache:false,
			// 	success: 
			// 	function(data){
			// 		location.reload();
			// 	}
			// });
		}).on("click","#stop" ,function (e) {
			$.ajax({
				type: "POST",
				url: MBL.BASE_URL+ "admin/question/stop", 
				data: { tid:$(this).data('tid'),mid : $(this).data('mid')},
				cache:false,
				success: 
				function(data){
					location.reload();
				}
			});
		});
		$("#button-addq").on('click', function() {
			$("#modal-container").show();
			$("#modal-container #popup #modal-addquestionare").show();
		});
	},
	add: function(e) {
		$(e).parent().children('#choices-li').append('<label class="checkbox"><input type="checkbox" name = "question[answers][]" value = "'+$('.checkbox').length+'"><input type = "text" class = "choices" name = "question[choices][]"><span class = "text-error text-size-s2" onclick = "question.del(this)">del</span></label>');	
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
		// $("#list-container").hide();
		// $("#grid-container").show();

		 $("#grid-container").hide();		
		 $("#list-container").show();

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

//(Create/Edit User) Hides first name and last name fields if role is not trainee
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
		$('.close-modal').click(function() {
			$(this).closest(".panel").hide();
			$("#modal-container").hide();
			$(".modal-container").hide();
		});		
		$('.close-panel:not(".close-modal")').click(function() {
			$(this).closest(".panel").hide();
		});
	}
}

//warning when trying to leave an ongoing test
var test_form = {
	initialize: function() {
		if ($('form').is('#test-form')) {
			if ($('body').hasClass('test')) {
				var warning = 'Leaving the test will mark your score as zero.\n\nAlso note that reloading the page will start another test, marking the previous one as zero.';
			} else if ($('body').hasClass('scheduled_test')) {
				var warning = 'Leaving the test will mark your score as zero.\nYou should finish this test as you can take this only once.';
			}
			var form_submitted = false;

			$('button[name="is_submit"]').on('click', function () {
				form_submitted = true;
			});

			$(window).on('beforeunload', function(){
				if (form_submitted == false) return warning;
			});
		}
	}
}