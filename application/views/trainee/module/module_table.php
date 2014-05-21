<!--<?php $this->load->view('trainee/module/module_table',array('modules' => $modules));?>-->
<table class="module-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Module Title</th>
			<!-- <th><?php echo $header_title?></th> -->
		</tr>
	</thead>
	<tbody>
		<?php if(isset($modules) && sizeof($modules) > 0):?>
			<?php foreach ($modules as $index => $module): ?>
				<tr>
					<td><?php echo $module->id?></td>
					<td><a href="<?php echo base_url('trainee/module/view'.$module->id)?>"><?=stripslashes($module->title)?></a></td>
					
					<!-- <td>
						<div class="panel">
							<div class="panel-heading">
								<h1 class="panel-title">
									<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
										<?=stripslashes($module->title)?>
									</a>
								</h1>
							</div>
							<div class="panel-body">
								<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
							</div>
						</div>
					</td> -->
				</tr>
			<?php endforeach; ?>
		<?php else:?>
			<tr>
				<td>No modules available for enrolment.</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>