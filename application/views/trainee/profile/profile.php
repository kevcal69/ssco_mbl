<div id="profile-container">
	<?php if (isset($scheduled_tests)):?>
		<?php foreach ($scheduled_tests as $test):?>
			<?php echo $this->load->view('trainee/test/scheduled_test_notice',$test);?>
		<?php endforeach;?>
	<?php endif;?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Personal Information</h3>
		</div>
		<div class="panel-body">
			<div class="table vertical-headings test-result-table">
				<div class="tr">
					<div class="th">First Name</div>
					<div class="td"><?php echo $statistics['name']['first_name']?></div>
				</div>
				<div class="tr">
					<div class="th">Last Name</div>
					<div class="td"><?php echo $statistics['name']['last_name']?></div>
				</div>
				<div class="tr">
					<div class="th">Username</div>
					<div class="td"><?php echo $statistics['name']['username']?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Enroled Modules (<?php echo (sizeof($statistics['modules']['current']) + sizeof($statistics['modules']['completed']))?>)</h3>
		</div>
		<div class="panel-body">	
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Current Modules (<?php echo sizeof($statistics['modules']['current'])?>)</h3>
				</div>
				<div class="panel-body">					
					<?php if(isset($statistics['modules']['current']) && sizeof($statistics['modules']['current']) > 0):?>
						<table>
							<thead>
								<tr>
									<th class="collapse nowrap center">ID</th>
									<th>Module Title</th>
									<th class="collapse nowrap center">Date Enroled</th>
									<th class="collapse nowrap center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($statistics['modules']['current'] as $index => $module): ?>
									<tr>
										<td class="collapse nowrap center"><?php echo $module['id']?></td>
										<td><a href="<?php echo base_url('trainee/module/view/'.$module['id'])?>"><?=stripslashes($module['title'])?></a></td>
										<td class="collapse nowrap center"><?php echo format_timestamp($module['date_enroled'])?></td>
										<td class="collapse nowrap center">
											<a class="button button-primary table-button" href="<?php echo base_url('trainee/module/view/'.$module['id'])?>">View</a>
											<a class="button table-button" href="<?php echo base_url('trainee/test/take/'.$module['id'])?>">Take Test</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else:?>
							No current modules.
					<?php endif;?>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Completed Modules (<?php echo sizeof($statistics['modules']['completed'])?>)</h3>
				</div>
				<div class="panel-body">
					<?php if (sizeof($statistics['modules']['completed']) > 0 && isset($statistics['modules']['completed'])):?>
						<table>
							<thead>
								<tr>
									<th class="collapse nowrap center">ID</th>
									<th>Module Title</th>
									<th class="collapse nowrap center">Date Enroled</th>
									<th class="collapse nowrap center">Date Completed</th>
									<th class="collapse nowrap center">Rating</th>
									<th class="collapse nowrap center">Times Test Taken</th>
									<th class="collapse nowrap center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($statistics['modules']['completed'] as $index => $module): ?>
									<tr>
										<td class="collapse nowrap center"><?php echo $module['id']?></td>
										<td><a href="<?php echo base_url('trainee/module/view/'.$module['id'])?>"><?=stripslashes($module['title'])?></a></td>
										<td class="collapse nowrap center"><?php echo format_timestamp($module['date_enroled'])?></td>
										<td class="collapse nowrap center"><?php echo format_timestamp($module['date_completed'])?></td>
										<td class="collapse nowrap center"><?php echo format_rating($module['rating'])?></td>
										<td class="collapse nowrap center"><?php echo $module['tests_taken']?></td>
										<td class="collapse nowrap center"><a class="button button-primary table-button" href="<?php echo base_url('trainee/module/view/'.$module['id'])?>">View</a></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else:?>
						No modules completed yet.
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Scheduled Tests (<?php echo sizeof($statistics['scheduled_tests'])?>)</h3>
		</div>
		<div class="panel-body">
			<?php if (sizeof($statistics['scheduled_tests']) > 0 && isset($statistics['scheduled_tests'])):?>
				<table>
					<thead>
						<tr>
							<th class="collapse nowrap center">Test ID</th>
							<th>Module</th>
							<th class="collapse nowrap center">Date Taken</th>
							<th class="collapse nowrap center">Rating</th>
							<th class="collapse nowrap center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($statistics['scheduled_tests'] as $index => $test): ?>
							<tr>
								<td class="collapse nowrap center"><?php echo $test['test_id']?></td>
								<td><?=stripslashes($test['module_title'])?></td>
								<td class="collapse nowrap center"><?php echo format_timestamp($test['date'])?></td>
								<td class="collapse nowrap center"><?php echo format_rating($test['rating'])?></td>
								<td class="collapse nowrap center"><a class="button button-primary table-button" href="<?php echo base_url('trainee/scheduled_test/result/'.$test['id'])?>">View Result</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else:?>
				No modules completed yet.
			<?php endif;?>
		</div>
	</div>
</div>