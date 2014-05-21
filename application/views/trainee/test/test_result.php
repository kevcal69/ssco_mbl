<!-- Form for test and test results -->
<div id="test-container">
	<div id="test-header">
		<h1 id="module-title"><?php echo $module_title?> - <?php echo format_rating($results['rating'])?></h1>
		<div id="action-buttons">
			<a href="<?php echo base_url('trainee/module/view/'.$module_id)?>" class="button button-primary">Back to Module</a>
		</div>
	</div>
	<hr>
	<div id="test-content">
		<form method="post" id="test-form">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Test Results</h3>
			</div>
			<div class="panel-body">
				<table class="vertical-headings test-result-table">
					<tr>
						<th>Correct Answers</th>
						<td><?php echo $results['score']?></td>
					</tr>
					<tr>
						<th>Number of Questions</th>
						<td><?php echo $results['total']?></td>
					</tr>
					<tr>
						<th>Rating</th>
						<td><?php echo format_rating($results['rating'])?></td>
					</tr>
				</table>
			</div>
		</div>
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
														disabled
														<?php if (isset($answers) && in_array($c_index,$answers[$index])) echo 'checked'?>
														> <?php echo chr(ord(('A')) + $c_index) . '. ' . $choice?>
									</label>
								<?php endforeach;?>
							</div>
						</div>
						<?php if ($results['answers'][$index] === TRUE):?>
							<p class="text-success"><i class = "fa fa-check fa-fw"></i> Correct!</p>
						<?php else: ?>
							<p class="text-error"><i class = "fa fa-times fa-fw"></i> Wrong.</p>
						<?php endif;?>
					</div>
				</div>
			<?php endforeach;?>
		</form>
		<hr>
		<a href="<?php echo base_url('trainee/module/view/'.$module_id)?>" id="process-results-bottom" class="button button-primary">Back to Module</a>
	</div>
</div>