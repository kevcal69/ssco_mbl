<!-- test results -->
<?php if (!empty($details)): ?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				Test Snapshot
			</h3>
		</div>
		<div class="panel-body">
			<a class="button" id="result-back" onclick="history.go(-1)">Back</a>
			<p>
				Shown below is the test result of 
				<b><?php echo $details['trainee']['first_name'].' '.$details['trainee']['last_name']?></b> 
				for module "<b><?php echo $module_title?></b>".
			</p>
			<table class="vertical-headings test-result-table">
				<tr>
					<th>Test ID</th>
					<td><?php echo $details['test_id']?></td>
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
		<h1 id="module-title"><?php echo $module_title?> - <?php echo format_rating($results['rating'])?></h1>
	</div>
	<hr>
	<div id="test-content">
		<form method="post">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Test Results</label>
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
	</div>
</div>