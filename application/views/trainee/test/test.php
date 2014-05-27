<div id="test-container">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Scheduled Tests (<?php echo sizeof($scheduled_tests)?>)</h3>
		</div>
		<div class="panel-body">
			<?php if (sizeof($scheduled_tests) > 0):?>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Module</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($scheduled_tests as $test):?>
						<tr>
							<td class="collapse nowrap center"><?php echo $test['test_id']?></td>
							<td><?php echo $test['module_title']?></a></td>
							<td class="collapse nowrap center"><a class="button button-primary table-button" href="<?php echo base_url('trainee/scheduled_test/take/'.$test['test_id'])?>">Take Test</a></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<?php else:?>
				No scheduled tests yet.
			<?php endif;?>
		</div>
	</div>
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Scheduled Test Results (<?php echo sizeof($scheduled_test_results)?>)</h3>
		</div>
		<div class="panel-body">
			<?php if (sizeof($scheduled_test_results) > 0):?>
				<?php echo $this->load->view('trainee/test/scheduled_test_results',array('scheduled_test_results', $scheduled_test_results))?>
			<?php else:?>
				No scheduled tests taken.
			<?php endif;?>
		</div>
	</div>
</div>