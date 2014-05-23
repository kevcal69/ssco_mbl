<!--<?php //echo $this->load->view('trainee/module/module_table',array('modules' => $modules));?>-->
<table class="module-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Module Title</th>
			<th>Module Description</th>
			<th style="display:none;">Module Content</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($modules) && sizeof($modules) > 0):?>
			<?php foreach ($modules as $index => $module): ?>
				<tr>
					<td><?php echo $module->id?></td>
					<td><a href="<?php echo base_url('trainee/module/view'.$module->id)?>"><?=stripslashes($module->title)?></a></td>
					<td><?=stripslashes($module->description)?></td>
					<td style="display:none;"><?=stripslashes($module->content)?></td>
				</tr>
			<?php endforeach; ?>
		<?php else:?>
			<tr>
				<td>No modules available for enrolment.</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>