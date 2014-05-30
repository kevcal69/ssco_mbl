<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$this->mModule->get_title($mid)?> - Scheduled Tests</h3>
	</div>
	<div class="panel-body">
	<?php if (isset($scheduled_test) && !empty($scheduled_test)):?>		
		<table id = "module-sched-stat-table">
			<thead>
				<tr>
					<th class="collapse nowrap center">Test ID</th>
					<th>Status</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($scheduled_test as $row): ?>
				<tr>
					<td class = "table-id collapse nowrap center"><?=$row->id?></td>
					<?php if(!$row->isset_test): ?>
						<td class = "table-id button-success" >Done</td>
					<?php else:?>
						<td class = "table-id button-danger" >Ongoing</td>
					<?php endif;?>
					<?php if(!$row->isset_test): ?>
					<td class="collapse nowrap center" id = "more-details" data-id = "<?=$row->id?>">
						<a href="<?=base_url() . 'admin/test/sched_results_view/'.$row->id?>" class="actions">Details</a>
					</td>
					<?php else:?>
					<td  id = "more-details" data-id = "<?=$row->id?>">
					<button type = "button" class = "button-danger table-button" id = "stop"  data-tid = "<?=$row->id?>" data-mid = "<?=$row ->module_id?>">
					<i class="fa fa-fw fa-thumb-tack"></i>Stop the Test
					</button>
					</td>
					<?php endif;?>

				</tr>
			<?php endforeach ?>
			</tbody>
		</table>	
	<?php else:?>		
		<div class="notif notif-danger">
			<div class="notif-icon">
				<i class="fa fa-fw fa-exclamation-triangle"></i>
			</div>
			<div class="notif-body">
				No Data Found : click <a href="<?=base_url('admin/question/test_set_up/'.$mid)?>">here</a> to create one
			</div>
		</div>		
	<?php endif;?>
	</div>
</div>