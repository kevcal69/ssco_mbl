<?php if (!empty($scheduled_test)): ?>
	<?php foreach ($scheduled_test as $test): ?>
		<div class="notif notif-warning">
			<div class="notif-icon">
				<button type = "button" class = "button-danger table-button float-r" id = "stop"  data-tid = "<?=$test->id?>" data-mid = "<?=$test ->module_id?>"><i class="fa fa-fw fa-thumb-tack"></i>Stop the Test</button>
			</div>
			<div class="notif-body">
				Scheduled Test for <?=word_limiter($this->mModule->get_title($test ->module_id,10))?> is ongoing. 
			</div>
		</div>
	<?php endforeach ?>
<?php endif; ?>
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Trainees List</h3>
	</div>
	<div class="panel-body">
		<table id = "users-stat-table">
			<thead>
				<tr>
					<th class="collapse nowrap center">Trainee ID</th>
					<th>Name</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($user_stats as $user_stat): ?>
				<tr>
					<td class="collapse nowrap center"><?=$user_stat['user_id']?></td>
			    <td><?=$user_stat['first_name']?> <?=$user_stat['last_name']?></td>
					<td class="collapse nowrap center">
						<a class="actions" href="<?=base_url() . 'admin/trainee/enrolment/'.$user_stat['user_id']?>" >Module Enrolment</a>
						<a class="actions" href="<?=base_url() . 'admin/trainee/module_test_view/'.$user_stat['user_id']?>">Module Test Result</a>
						<a class="actions" href="<?=base_url() . 'admin/trainee/schedule_test_view/'.$user_stat['user_id']?>" >Scheduled Test Result</a>
					</td>
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>		
	</div>
</div>


