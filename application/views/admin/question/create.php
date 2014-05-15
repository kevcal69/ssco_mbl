<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?= base_url() .  'assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js';?>"></script>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Question List</h3>
	</div>
	<div class="panel-body question-list">
		<?php foreach ($questions as $question): ?>
		<div class="panel panel-primary item">
			<div class="panel-heading">
				<button type = "button" class = "button-warning show_d">Show Details</button>
				<h3 class="panel-title"><?=$question->qtitle?></h3>
			</div>
			<div class="panel-body item-body">
				
			</div>
				

		</div>	
		<?php endforeach; ?>
	</div>
</div>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Add Question</h3>
	</div>
	<div class="panel-body">
		<form action = "<?=base_url('admin/question/create_question')?>" class="form-horizontal" method = "POST">
		<fieldset>
			<input type = "hidden" name = "question[module]" value = "<?=$module->id?>"/>
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
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">How to format</h3>
						</div>
						<div class="panel-body">
							<ul>
								<li>Always check for the source</li>
								<li>Always check for source</li>
								<li>Choices for answers should be place in pre (see paragraph format ->formatted) number bullet list </li>
							</ul>
						</div>
					</div>					
				</div>	
			<div class="control-group">
				<label>Choices</label>
				<div class="controls" id = "choices-li">
				<label class="checkbox"><input type="checkbox" checked value="0" name = "question[answers][]"><input type = "text" placeholder = "Choices" class = "choices" name = "question[choices][]"><span class = "text-error text-size-s2" onclick = "question.del(this)">del</span></label>
				<button type = "button" class = "button-success" onclick="question.add()">Add</button>
				</div>
			</div>		
			<button  class = "button-warning">Save</button>		
		</fieldset>			
		</form>
	</div>
</div>