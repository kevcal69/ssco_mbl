<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">
			User Information
		</h3>
	</div>
	<div class="panel-body">

		<div class="table vertical-headings test-result-table">
			<div class="tr">
				<div class="th">User ID</div>
				<div class="td"><?=$tid?></div>
			</div>
			<div class="tr">
				<div class="th">Username</div>
				<div class="td"><?=$user_info['username']?></div>
			</div>
			<div class="tr">
				<div class="th">First Name</div>
				<div class="td"><?=$user_info['first_name']?></div>
			</div>
			<div class="tr">
				<div class="th">Last Name</div>
				<div class="td"><?=$user_info['last_name']?></div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Enroled Modules</h3>
	</div>
	<div class="panel-body">
		<table class="module-table-admin">
			<thead>
				<tr>
					<th class="collapse nowrap center">ID</th>
					<th>Module Title</th>
					<th class="collapse nowrap center">Date Enroled</th>
					<th class="collapse nowrap center">Date Completed</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($enroled_modules as $module): ?>
				<tr>
					<td class="collapse nowrap center"><?=$module->module_content->id?></td>
					<td>
						<?=$module->module_content->title?>
					</td>
					<td class="collapse nowrap center"><?=format_timestamp($module->date_enroled)?></td>
					<?php if ($module->is_completed):?>
						<td class="collapse nowrap center"><?=format_timestamp($module->date_enroled)?></td>
					<?php else:?>
						<td class="collapse nowrap center">Not Completed</td>
					<?php endif;?>
					<td class="collapse nowrap center">
						<a class="actions text-muted" href="<?=base_url('admin/module/view/'.$module->module_content->id)?>" class = "text-info text-size-s3">View</a>
						<a class="actions text-error" href="<?=base_url('admin/trainee/unenrol/'.$tid.'/'.$module->module_content->id)?>" class = "text-primary text-size-s3">Unenrol</a>
					</td>
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>			
	</div>
</div>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Available Modules</h3>
	</div>
	<div class="panel-body">
		<table class="module-table-admin">
			<thead>
				<tr>
					<th class="collapse nowrap center">ID</th>
					<th>Module Title</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($available_modules as $module): ?>
				<tr>
					<td class="collapse nowrap center"><?=$module->id?></td>
					<td>
						<?=$module->title?>
					</td>
						<td class="collapse nowrap center">
							<a class="actions text-muted" href="<?=base_url('admin/module/view/'.$module->id)?>" class = "text-info text-size-s3">View</a>
							<a class="actions" href="<?=base_url('admin/trainee/enrol/'.$tid.'/'.$module->id)?>" class = "text-primary text-size-s3">Enrol</a>
						</td>
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>			
	</div>
</div>