<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?= base_url() .  'assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js';?>"></script>

<div class="panel">
	<div class="panel-heading">	
		<?php if (isset($test) && (!isset($test->isset_test) || $test->isset_test == FALSE)):?>
			<button type = "button" class = "button-info">Coduct a Test</button>
		<?php else:?>	
			<?=isset($test->isset_test) ?>
			<button type = "button" class = "button-danger">Stop the Test</button>
		<?php endif;?>
	</div>
	<div class="panel-body question-list" id ="qbody">
	<div class="panel-heading" id = "results-filter">
		<span>Filter By :</span>
		<select id = "filter" data-mid ="<?=$module->id?>">
			<option value = "1">Tagged</option>
			<option value = "0">Untagged</option>
			<option value = "2"selected="selected">Mixed</option>
		</select>
		<span>Keyword :</span>
		<input type = "text">
	</div>
	<?php foreach ($questions as $question): ?>
	<div class="item">
		<div class="item-heading">
			<div class="item-id">
				<span class = "text-warning qid-label"><?=$question->id?></span>
				<span class = "text-warning mid-label"><?=$module->id?></span>
			</div>
	<?php if ($question->is_used == 1):?>	
			 <i class="fa fa-tag fa-fw text-muted"></i> <h3 class = "text-info que-tit"><?=$question->qtitle?></h3>
			<div class="opt-group">
				<span class="edit"><i class="fa fa-gear"></i>Edit</span>
				<span class="set-test" data-id = "<?=$question->id?>" data-mid = "<?=$module->id?>" data-val = "0"><i class="fa fa-times text-error"></i>Exclude</span>
			</div>
	<?php elseif ($question->is_used == 0):?>
			<h3 class = "text-info que-tit"><?=$question->qtitle?></h3>
			<div class="opt-group">
				<span class="edit"><i class="fa fa-gear"></i>Edit</span>
				<span class="set-test" data-id = "<?=$question->id?>" data-mid = "<?=$module->id?>" data-val = "1"><i class="fa fa-check text-success"></i>Include</span>
			</div>				
	<?php endif;?>
		</div>
		<div class="show_d">
			<span class = "text-warning sh_mr">Show More</span>
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
		<div class="panel" id ="questionare">
			<form action = "<?=base_url('admin/question/edit_test_question')?>" method = "POST">
				<div class="panel-heading">
					<h3 class="panel-title">
						<input type = "hidden" name = "question[id]" value = "<?=$question->id?>"/>
						<input type = "hidden" name = "question[module]" value = "<?=$module->id?>"/>
						<input type = "text" name = "question[title]" value = "<?=$question->qtitle?>" class = "qfield" />
					</h3>
				</div>
				<div class="panel-body">
					<div id="econtainer">
					<textarea id = "edit-area" name = "question[question]" placeholder = "Question"><?=$question->question?></textarea>
					</div>
					
				</div>
				<div class="panel-footer">
						<div class="control-group">
							<label>Choices</label>
							<div class="controls" id = "choices-li">
								<?=edit_ca(unserialize(base64_decode($question->choices)),unserialize(base64_decode($question->answer)))?>
							</div>
							<button type = "button" class = "" onclick="question.add()">Add</button>
						</div>		
						<button  class = "button-success">Save</button>				
				</div>
			</form>
		</div>

	</div>
	<?php endforeach; ?>

	</div>
</div>



<form action = "<?=base_url('admin/question/create_test_question')?>" method = "POST">
<div class="panel" id ="questionare">
	<div class="panel-heading">
		<h3 class="panel-title">
			<input type = "hidden" name = "question[module]" value = "<?=$module->id?>"/>
			<input type = "text" name = "question[title]"placeholder = "Question Title?" class = "qfield" />
		</h3>
	</div>
	<div class="panel-body">
		<div id="econtainer">
		<textarea id = "q-area" name = "question[question]" placeholder = "Question"></textarea>
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
				<button type = "button" class = "" onclick="question.add()">Add</button>
			</div>		
			<button  class = "button-success">Save</button>				
	</div>
</div>
</form>

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
	





