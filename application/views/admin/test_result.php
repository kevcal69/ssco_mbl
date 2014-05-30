<!-- test results -->
<?php if (isset($details) && !empty($details)): ?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				Test Snapshot
			</h3>
		</div>
		<div class="panel-body">
			<a class="button" id="result-back" onclick="history.go(-1);window.close();">Back</a>
			<p>
				Shown below is the test result of 
				<b><?php echo $details['trainee']['first_name'].' '.$details['trainee']['last_name']?></b> 
				for module "<b><?php echo $details['module_title']?></b>".
			</p>

			<div class="table vertical-headings test-result-table">
				<div class="tr">
					<div class="th">Test ID</div>
					<div class="td"><?php echo $details['test_result_id']?></div>
				</div>
				<div class="tr">
					<div class="th">Trainee Name</div>
					<div class="td"><?php echo $details['trainee']['last_name'].', '.$details['trainee']['first_name']?></div>
				</div>
				<div class="tr">
					<div class="th">Trainee ID</div>
					<div class="td"><?php echo $details['trainee_id']?></div>
				</div>
				<div class="tr">
					<div class="th">Module Title</div>
					<div class="td"><?php echo $details['module_title']?></div>
				</div>
				<div class="tr">
					<div class="th">Module ID</div>
					<div class="td"><?php echo $details['module_id']?></div>
				</div>
				<div class="tr">
					<div class="th">Date Taken</div>
					<div class="td"><?php echo format_timestamp($details['date'])?></div>
				</div>
				<div class="tr">
					<div class="th">Rating</div>
					<div class="td"><?php echo format_rating($details['rating'])?></div>
				</div>
			</div>

		</div>
	</div>
<?php endif;?>

<?php if (!isset($results)):?>
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Notice: No Test Content</h3>
		</div>
		<div class="panel-body">
			This test has been aborted by the user. As such, there are no records of the answers.
		</div>
	</div>
<?php endif;?>
<div id="test-container">
	<div id="test-header">
		<h1 id="module-title"><?php echo $module_title?><?php if(isset($results)) echo ' - '.format_rating($results['rating'])?></h1>
	</div>
	<hr>
	<div id="test-content">
		<form>
	<?php if (isset($results)):?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Test Results</h3>
			</div>
			<div class="panel-body">
			<?php if ($this->session->userdata('role') && $this->session->userdata('role') === "admin"): ?>
				<?php if ($action === 'sched_result'):?>
					<a href="<?=base_url() . 'admin/test/sched_answers/'.$details['test_result_id'] ?>" class = "button button-warning">View Correct Answers</a>
				<?php else:?>
					<a href="<?=base_url() . 'admin/test/answers/'.$details['test_result_id'] ?>" class = "button button-warning">View Correct Answers</a>
				<?php endif;?>
			<?php endif; ?>
				<div class="table vertical-headings test-result-table">
					<div class="tr">
						<div class="th">Correct Answers</div>
						<div class="td"><?php echo $results['score']?></div>
					</div>
					<div class="tr">
						<div class="th">Number of Questions</div>
						<div class="td"><?php echo $results['total']?></div>
					</div>
					<div class="tr">
						<div class="th">Rating</div>
						<div class="td"><?php echo format_rating($results['rating'])?></div>
					</div>

				</div>
			</div>
			
		</div>
	<?php endif;?>
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
						<?php if (isset($results)):?>
							<?php if ($results['answers'][$index] === TRUE):?>
								<p class="text-success"><i class = "fa fa-check fa-fw"></i> Correct!</p>
							<?php else: ?>
								<p class="text-error"><i class = "fa fa-times fa-fw"></i> Wrong.</p>
							<?php endif;?>
						<?php endif;?>
					</div>
				</div>
			<?php endforeach;?>
		</form>
	</div>
</div>