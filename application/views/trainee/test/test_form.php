<!-- Form for test -->
<div id="test-container">
	<?php if (validation_errors()):?>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Error submitting test</h3>
			</div>
			<div class="panel-body">
				There are questions that are not answered. Please answer them before submitting the test.
			</div>
		</div>
	<?php endif;?>
	<div id="test-header">
		<h1 id="module-title"><?php echo $module_title?></h1>
		<div id="action-buttons">
			<button type="submit" name="is_submit" value="TRUE" class="button-primary" form="test-form">Submit</button>
		</div>
	</div>
	<hr>
	<div id="test-content">
		<?php echo form_open('trainee/test/take/'.$module_id,array('id' => 'test-form'));?>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Instructions</h3>
			</div>
			<div class="panel-body">
				Insert Instructions Here
			</div>
		</div>
			<input type="hidden" name="questions-string" value="<?php echo $questions_string?>"/>
			<?php foreach($questions as $index => $question):?>
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo ($index+1).'. '.$question->qtitle?></h3>
					</div>
					<div class="panel-body">
						<?php echo $question->question?>
					</div>
					<div class="panel-footer">
						<div class="control-group">
							<div class="controls">
								<?php foreach (unserialize_choices($question->choices) as $c_index => $choice):?>
									<label class="checkbox">
										<input	type="checkbox" 
														name="answers[<?php echo $index?>][]" 
														value="<?php echo $c_index?>" 
														<?php echo set_checkbox('answers['.$index.'][]', $c_index); ?>
														> <?php echo chr(ord(('A')) + $c_index) . '. ' . $choice?>
									</label>
								<?php endforeach;?>
							</div>
						</div>
						<?php echo form_error('answers['.$index.'][]','<p class="text-error">','</p>');?>
					</div>
				</div>
			<?php endforeach;?>
			<input form="test-form" type="hidden" name="module-title" value="<?php echo $module_title?>"/>
			<input form="test-form" type="hidden" name="module-id" value="<?php echo $module_id?>"/>
			<?php if (isset($test_id)):?>
				<input form="test-form" type="hidden" name="test-id" value="<?php echo $test_id?>"/>
			<?php endif;?>
		</form>
		<hr>
		<button id="submit-bottom" type="submit" name="is_submit" value="TRUE" class="button-primary" form="test-form">Submit Answers</button>
	</div>
</div>

<script>
	var warning = 'Leaving the test will mark your score as zero.\n\nAlso note that reloading the page will start another test, marking the previous one as zero.';
	$(document).ready(function() {
		$('button[type="submit"], input[type="submit"]').on('mousedown', function() {
			stopNavigate();
			$('#test-form').submit();
		});

		$('button[type="submit"], input[type="submit"]').on('mouseleave', function () {
			$(window).on('beforeunload', function(){
				return warning;
			});
		});
	});

	$(window).on('beforeunload', function(){
		return warning;
	});

	function stopNavigate(){
		$(window).off('beforeunload');
	}
</script>