<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?= base_url() .  'assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js';?>"></script>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Question List</span>
		<button class="button-info float-r" id = "button-addq"><i class = "fa fa-plus"></i>Question</button>
	</div>
	<div class="panel-body question-list" id = "qbody">
		<?php foreach ($questions as $question): ?>
		<div class="item">
			<div class="item-heading">
				<h3 class = "que-tit text-info"><?=$question->qtitle?></h3>
			
			<div class="item-id">
				<span class = "text-warning qid-label"><?=$question->id?></span>
				<span class = "text-warning mid-label"><?=$module->id?></span>
			</div>
			</div>
			<div class="show_d">
				<span class = "qedit text-muted" data-id = "<?=$question->id?>"><i class="fa fa-gear"></i>Edit</span>
				<span class = "text-warning sh_mr inline-display">Show More</span>
			</div>	
			<div class="item-body">
				<h4 class = "item-title">Question</h4>
				<div class="panel panel-body">
					<p><?=$question->question?></p>
				</div>
				<h4 class = "item-title">Choices and Answers</h4>
				<div class="panel panel-body">
					<?=display_ca(unserialize(base64_decode($question->choices)),unserialize(base64_decode($question->answer)))?>
				</div>				
			</div>
<div class = "modal-container modal-container<?=$question->id?>">
	<div id="popup">
		<div id ="questionare" class="panel">
			<div class="panel-heading">
			<span class="close-panel close-modal"><i class = "fa fa-times fa-fw"></i></span>
				<h3 class="panel-title">Edit Question</h3>
			</div>	
			<form action = "<?=base_url('admin/question/edit_question')?>" method = "POST">
						<input type = "hidden" name = "question[id]" value = "<?=$question->id?>"/>
						<input type = "hidden" name = "question[module]" value = "<?=$module->id?>"/>
				<div class="panel-body">
					<input type = "text" name = "question[title]" value = "<?=$question->qtitle?>" class = "qfield" />
					<div id="econtainer">
					<textarea id = "edit<?=$question->id?>" name = "question[question]" placeholder = "Question"><?=$question->question?></textarea>
					<script type="text/javascript">
						CKEDITOR.replace( 'edit'+<?=$question->id?>, {
							resize_enabled : false,
							removePlugins : 'autosave',				
							toolbar: [
								[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
								{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
								'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
								{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
							],
						});	
					</script>					
					</div>
					<div id="instruction">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">How to format</h3>
							</div>
							<div class="panel-body">
								<ul>
									<li>Always check for the source</li>
									<li>Always check for source</li>
									<li>Choices are found below check the checkbox if the choice is an answer</li>
								</ul>
							</div>
						</div>					
					</div>									
					
				</div>
				<div class="panel-footer">
						<div class="control-group">
							<label>Choices</label>
							<div class="controls" id = "choices-li">
								<?=edit_ca(unserialize(base64_decode($question->choices)),unserialize(base64_decode($question->answer)))?>
							</div>
							<button type = "button" class = "" onclick="question.add(this)">Add</button>
						</div>		
						<button  class = "button-success">Save</button>				
				</div>
			</form>
		</div>
	</div>
</div>			
		
		</div>	
		<?php endforeach; ?>
	</div>
</div>
<div id = "modal-container">
	<div id="popup">
		<div class="panel" id = "modal-addquestionare">
			<div class="panel-heading">
			<span class="close-panel close-modal"><i class = "fa fa-times fa-fw"></i></span>
				<h3 class="panel-title">Add Question</h3>
			</div>		
			<form action = "<?=base_url('admin/question/create_question')?>" method = "POST">
				<input type = "hidden" name = "question[module]" value = "<?=$module->id?>"/>
			<div class="panel-body">
				<input type = "text" name = "question[title]"placeholder = "Question Title?" class = "qfield" />
				<div id="econtainer">
					<textarea id = "q-area" name = "question[question]" placeholder = "Question"></textarea>	
					<script type="text/javascript">
						CKEDITOR.replace( 'q-area', {
							resize_enabled : false,
							removePlugins : 'autosave',				
							toolbar: [
								[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
								{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
								'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
								{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
								],
						});
					</script>
				</div>
				<div id="instruction">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">How to format</h3>
						</div>
						<div class="panel-body">
							<ul>
								<li>Always check for the source</li>
								<li>Always check for source</li>
								<li>Choices are found below check the checkbox if the choice is an answer</li>
							</ul>
						</div>
					</div>					
				</div>	
			</div>
			<div class="panel-footer">
				<div class="control-group">
					<label>Choices</label>
					<div class="controls" id = "choices-li">
						<label class="checkbox">
							<input type="checkbox" checked value="0" name = "question[answers][]">
							<input type = "text" placeholder = "Choices" class = "choices" name = "question[choices][]">
							<span class = "text-error text-size-s2" onclick = "question.del(this)">del</span>
						</label>
					</div>
						<button type = "button" class = "" onclick="question.add(this)">Add</button>
				</div>		
				<button  class = "button-success">Save</button>				
			</div>
			</form>
		</div>		
	</div>
</div>

