<!-- test results -->
<?php if (!empty($details)): ?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				Test Correct Answers
			</h3>
		</div>
		<div class="panel-body">
			<a class="button" id="result-back" onclick="history.go(-1);window.close();">Back</a>
			<p>
				Shown below are the correct answers for the test taken by 
				<b><?php echo $details['trainee']['first_name'].' '.$details['trainee']['last_name']?></b> 
				for module "<b><?php echo $module_title?></b>".
			</p>
			<table class="vertical-headings test-result-table">
				<tr>
					<th>Test ID</th>
					<td><?php echo $details['test_result_id']?></td>
				</tr>
				<tr>
					<th>Trainee Name</th>
					<td><?php echo $details['trainee']['last_name'].', '.$details['trainee']['first_name']?></td>
				</tr>
				<tr>
					<th>Trainee ID</th>
					<td><?php echo $details['trainee_id']?></td>
				</tr>
				<tr>
					<th>Module Title</th>
					<td><?php echo $module_title?></td>
				</tr>
				<tr>
					<th>Module ID</th>
					<td><?php echo $details['module_id']?></td>
				</tr>
				<tr>
					<th>Date Taken</th>
					<td><?php echo format_timestamp($details['date'])?></td>
				</tr>
			</table>
		</div>
	</div>
<?php endif;?>

<div id="test-container">
	<div id="test-header">
		<h1 id="module-title"><?php echo $module_title?> - Correct Answers</h1>
	</div>
	<hr>
	<div id="test-content">
		<form method="post">
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
					</div>
				</div>
			<?php endforeach;?>
		</form>
	</div>
</div>